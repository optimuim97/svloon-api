<?php

namespace App\Http\Controllers\API\QuickService;

use App\Http\Controllers\AppBaseController;
use App\Models\Appointement;
use App\Models\QuickService;
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
     *      path="/auth/quick-services",
     *      summary="createQuickService",
     *      tags={"QuickService"},
     *      description="Create QuickService",
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          @OA\Schema(type="string")
     *        ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/QuickService"),
     *        @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              required={"service_id,address,lat,lon,user_id,duration,is_confirmed,has_already_send_remeber"},
     *              @OA\Property(property="service_id", type="string"),
     *              @OA\Property(property="address", type="string"),
     *              @OA\Property(property="lat", type="string"),
     *              @OA\Property(property="lon", type="string"),
     *              @OA\Property(property="user_id", type="string"),
     *              @OA\Property(property="note", type="string"),
     *              @OA\Property(property="duration", type="string"),
     *              @OA\Property(property="is_report", type="string"),
     *              @OA\Property(property="is_cancel", type="string"),
     *              @OA\Property(property="payment_method_id", type="integer"),
     *              @OA\Property(property="payment_method_type_id", type="integer"),
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
        $request->validate(QuickService::$rules);
        $currentDate = Carbon::now();

        // $hour = $input["hour"];
        $date = Carbon::parse($input["date"]);
        $checkDate = $currentDate->diffInHours($date, true);

        if ($checkDate <= 3) {
            return $this->sendError("Le RDV doit etre fixe avec 3 heures d'avances", 422);
        }

        $input["date"] = $date;

        $latitude = $input["lat"];
        $longtitude = $input["lon"];

        $nearlySalons = $this->getSalon(
            $latitude,
            $longtitude
        );

        $salonAvailabilities = $nearlySalons->availabilities;

        $check = $this->checkAvailability($salonAvailabilities, $input['date']);

        if ($check) {
            if (!empty($nearlySalons)) {

                $quickService = $this->quickServiceRepository->create($input);

                $appointement = Appointement::create([
                    'creator_id' => $user->id,
                    'user_id' => $input["user_id"],
                    'date' => $input["date"],
                    'hour' => Carbon::parse($input["date"])->format('H:i:s'),
                    'date_time' => Carbon::parse($input["date_time"])->format('Y-m-d H:i:s'),
                    'reference' => Str::uuid(),
                    'is_confirmed' => false,
                    'is_report' => false,
                    'is_cancel' => false,
                    'report_date' => null,
                    'appointment_status_id' => 1
                ]);

                if ($quickService) {
                    return $this->sendResponse([
                        "service_rapide" => $quickService->toArray(),
                        "details_rdv" => $appointement->toArray()
                    ], 'Service Rapide enregister avec success');
                    //TODO send Email
                }

                return $this->sendError("Reservation non pris en compte");
            }
        }

        return $this->sendError("Pas de salon a proximite");
    }

    public function getSalon($latitude, $longtitude)
    {
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
    }

    public function checkAvailability($salonAvailabilities, $date)
    {
        foreach ($salonAvailabilities as $availability) {
            $check = Carbon::parse($date)
                ->between(
                    Carbon::parse($availability->hour_start),
                    Carbon::parse($availability->hour_end)
                );

            if ($check == true) {
                return true;
            }
        }
    }
}
