<?php

namespace App\Http\Controllers\API\QuickService;

use App\Http\Controllers\AppBaseController;
use App\Models\Appointement;
use App\Models\Order;
use App\Models\QuickService;
use App\Models\Salon;
use App\Models\SalonService;
use App\Models\Service;
use App\Repositories\QuickServiceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateQuickServiceApiController extends AppBaseController
{
    private QuickServiceRepository $quickServiceRepository;

    public function __construct(QuickServiceRepository $quickServiceRepo)
    {
        $this->quickServiceRepository = $quickServiceRepo;
    }

    /**
     * @OA\Post(
     *      path="/auth/request-quick-service",
     *      summary="createQuickService",
     *      tags={"QuickService"},
     *      description="Create QuickService",
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/QuickService"),
     *        @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              required={"service_id,address,lat,lon,duration,is_confirmed,has_already_send_remeber"},
     *              @OA\Property(property="service_id", type="string"),
     *              @OA\Property(property="address", type="string"),
     *              @OA\Property(property="lat", type="string"),
     *              @OA\Property(property="lon", type="string"),
     *              @OA\Property(property="note", type="string"),
     *              @OA\Property(property="duration", type="string"),
     *              @OA\Property(property="is_report", type="string"),
     *              @OA\Property(property="is_cancel", type="string"),
     *              @OA\Property(property="payment_method_id", type="integer"),
     *              @OA\Property(property="payment_type_id", type="integer"),
     *              @OA\Property(property="is_confirmed", type="string"),
     *              @OA\Property(property="has_already_send_remeber", type="string")
     *          )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/QuickService"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function __invoke(Request $request)
    {
        $input = $request->all();
        $user = auth("api")->user();

        if ($user == null) {
            return $this->sendError("Votre session a expire", 401);
        }

        $input["user_id"] = $user->id;

        $input['payment_method_id'] = $input['payment_method_id'] ?? 1;
        $input['payment_type_id'] = $input['payment_type_id'] ?? 1;

        $request->validate(QuickService::$rules);
        $currentDate = Carbon::now();

        $date = Carbon::parse($input["date"]);
        $checkDate = $currentDate->diffInHours($date, true);

        if ($checkDate <= 3) {
            return $this->sendError("Le RDV doit etre fixe avec 3 heures d'avances", 422);
        }

        $input["date"] = Carbon::parse($date)->format('Y-m-d');
        $input["hour"] = Carbon::parse($input['hour'])->format('H:i:s');

        $latitude = $input["lat"];
        $longtitude = $input["lon"];

        $nearlySalons = $this->getSalon(
            $latitude,
            $longtitude
        );

        if (empty($nearlySalons?->toArray())) {
            return $this->sendError("Pas de salon a proximite");
        }

        foreach ($nearlySalons as $nearlySalon) {
            $nearlySalon = Salon::find($nearlySalon->salon_id);
            $salonAvailabilities = $nearlySalon?->availabilities;

            if (!$salonAvailabilities) {
                return $this->sendError("Pas de Salon à proximité");
            }

            //Check Service list
            // $service = Service::find($input["service_id"]);
            // $checkIfServiceIsAvailable = $this->checkService($nearlySalon->quick_service_list, $service);

            $check = $this->checkAvailability($salonAvailabilities, $input['date'], $input["hour"]);

            if ($check) {

                if (!empty($nearlySalon)) {

                    $input["hour"] = Carbon::parse($input["hour"])->format('Y-m-d H:i:s');
                    $salon_service_id = $input['salon_service_id'];
                    unset($input["salon_service_id"]);
                    $quickService = $this->quickServiceRepository->create($input);

                    $appointement = Appointement::create([
                        'creator_id' => $user->id,
                        'user_id' => $input["user_id"],
                        'date' => Carbon::parse($input["hour"]),
                        'hour' => Carbon::parse($input["hour"]),
                        'date_time' => Carbon::parse($input["date"])->format('Y-m-d H:i:s'),
                        'reference' => Str::uuid(),
                        'is_confirmed' => false,
                        'is_report' => false,
                        'is_cancel' => false,
                        'report_date' => null,
                        'salon_service_id' => $input['salon_service_id'] ?? null,
                        'service_id' => $input['service_id'] ?? null,
                        'appointment_status_id' => 1
                    ]);

                    $serviceSalon = SalonService::find($salon_service_id);
                    if (!empty($salon_service_id)) {
                        $input['total_price'] = $serviceSalon->prix;
                        $price = $input['total_price'];
                        //TODO add extra to price calculate
                        $extras_selected = $input['extras'] ?? null;

                        if (!empty($extras_selected)) {
                            foreach ($extras_selected as $extra) {
                                $price = float($extras_selected) + float($extra->price);
                            }
                        }
                    } elseif (!empty($input["service_id"])) {
                        $input['total_price'] = (Service::find($input['service_id']))->price;
                    }

                    $salon = Salon::find($serviceSalon->salon_id);
                    $staff = $salon->staff;

                    if (!empty($staff)) {
                        //TODO filter staff
                        $artist = $staff['0']['artist'];
                    }

                    $order = Order::create(
                        [
                            'salon_id' => $serviceSalon->salon_id,
                            'artist_id' => $artist ?? 1,
                            'details' => $input['details'] ?? "Service Rapide ",
                            'instructions' => $input['instructions'] ?? "Instructions",
                            'total_price' => $input['total_price'],
                            'date' => Carbon::parse($input["date"])->format('Y-m-d H:i:s'),
                            "order_status_id" => 1
                        ]
                    );

                    if ($quickService) {

                        return $this->sendResponse([
                            "service_rapide" => $quickService->toArray(),
                            "appointement" => $appointement->toArray(),
                            "order" => $order->toArray(),
                        ], 'Service Rapide enregister avec success');

                        //TODO send Email
                    } else {
                        return $this->sendError("Reservation non pris en compte");
                    }
                }
            } else {

                return $this->sendError("Salon non disponible");
            }
        }
    }

    public function getSalon($latitude, $longtitude)
    {

        // SELECT latitude, longitude, SQRT(
        //     POW(69.1 * (latitude - [startlat]), 2) +
        //     POW(69.1 * ([startlng] - longitude) * COS(latitude / 57.3), 2)) AS distance
        // FROM salon_addresses HAVING distance < 25 ORDER BY distance;

        return DB::table("salons")
            ->join("salon_addresses", "salons.id", "=", "salon_addresses.salon_id")
            ->select(
                "*",
                DB::raw("55555 * acos(cos(radians(" . $latitude . "))
                        * cos(radians(salon_addresses.lat))
                        * cos(radians(salon_addresses.lon) - radians(" . $longtitude . "))
                        + sin(radians(" . $latitude . "))
                        * sin(radians(salon_addresses.lat))) AS distance")
            )
            ->groupBy("salon_addresses.id")
            ->get();

        // return DB::table("salons")
        //     ->join("salon_addresses", "salons.id", "=", "salon_addresses.salon_id")
        //     ->select(
        //         "*",
        //         DB::raw("55555 * acos(cos(radians(" . $latitude . "))
        //         * cos(radians(salon_addresses.lat))
        //         * cos(radians(salon_addresses.lon) - radians(" . $longtitude . "))
        //         + sin(radians(" . $latitude . "))
        //         * sin(radians(salon_addresses.lat))) AS distance")
        //     )
        //     ->groupBy("salon_addresses.id")
        //     ->get();
    }

    public function checkAvailability($salonAvailabilities, $date, $hour)
    {
        $combinatedDateTime = Carbon::parse("$date $hour");

        foreach ($salonAvailabilities as $availability) {
            $day = Carbon::parse($availability->date)->format('Y-m-d');

            $start =   Carbon::parse("$day $availability->hour_start");
            $end =   Carbon::parse("$day $availability->hour_end");

            $check = $combinatedDateTime
                ->between(
                    Carbon::parse($start),
                    Carbon::parse($end)
                );

            if ($check == true) {
                return true;
            }
        }
    }

    public function checkService($salonService, $service)
    {
        return response()->json([
            "salonService" => $salonService,
            "service" => $service
        ]);
    }
}
