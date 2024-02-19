<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Appointement;
use App\Models\SalonService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AppointementRepository;
use App\Http\Requests\API\CreateAppointementAPIRequest;
use App\Http\Requests\API\UpdateAppointementAPIRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Service;

/**
 * Class AppointementController
 */

class AppointementAPIController extends AppBaseController
{

    private AppointementRepository $appointementRepository;

    public function __construct(AppointementRepository $appointementRepo)
    {
        $this->appointementRepository = $appointementRepo;
    }

    /**
     * @OA\Get(
     *      path="/appointements",
     *      summary="getAppointementList",
     *      tags={"Appointement"},
     *      description="Get all Appointements",
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
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Appointement")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $appointements = $this->appointementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appointements->toArray(), 'Appointements retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/auth/appointements",
     *      summary="createAppointement",
     *      tags={"Appointement"},
     *      description="Create Appointement",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Appointement")
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
     *                  ref="#/components/schemas/Appointement"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAppointementAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $creator = auth("api")->user();
        $user_id = $input["user_id"];
        $user = User::find($user_id);

        if (empty($user)) {
            return $this->sendResponse([], "L'utilisateur n'existe pas");
        }

        $input["user_id"] = $user->id;

        if (empty($creator)) {
            return $this->sendResponse([], "L'utilisateur doit être connecté");
        }

        $service_id = $input["salon_service_id"];

        $salonService = SalonService::where(["salon_service_id" => $service_id, "salon_id" => $user->id]);

        if (empty($salonService)) {
            return $this->sendResponse([], "Ce service n'existe");
        }

        $date = $input['date'];
        $hour = $input['hour'];

        $combinatedDateTime = Carbon::parse("$date $hour");
        #   123D    XX
        if ($combinatedDateTime->isPast()) {
            return $this->sendError('Vous ne pouvez pas choisir une date passé');
        }

        if ($user->id == $creator->id) {
            return $this->sendError('Vous ne pouvez pas de rendez-vous avec vous même');
        }

        if (!empty($input["salon_service_id"])) {
            $input['total_price'] = (SalonService::find($input['salon_service_id']))?->price;
        } elseif (!empty($input["service_id"])) {
            $input['total_price'] = (Service::find($input['service_id']))->price;
        }

        $input['creator_id'] = auth("api")->user()?->id;
        $input['datetime'] = $combinatedDateTime;
        $input['hour'] = $combinatedDateTime;
        $input['reference'] = Str::uuid();
        $input['appointment_status_id'] = 1;
        $appointement = $this->appointementRepository->create($input);

        // $fees = $this->calculateFee($this->percent);

        $order = Order::create(
            [
                "appointement_id" => $appointement->id,
                'salon_id' => $input['salon_id'] ?? null,
                'artist_id' => $input['artist_id'] ?? null,
                'order_status_id' => 1,
                'details' => $input['details'],
                'instructions' => $input['instructions'],
                'total_price' => floatval($input['total_price']) + ($fees ?? 0),
                'date' => Carbon::parse($input["date"])->format('Y-m-d H:i:s')
            ]
        );

        return $this->sendResponse([
            "appointement" => new AppointmentResource($appointement) ,
            "order" => new OrderResource($order)
        ], 'RDV ajouté');
    }

    /**
     * @OA\Get(
     *      path="/appointements/{id}",
     *      summary="getAppointementItem",
     *      tags={"Appointement"},
     *      description="Get Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
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
     *                  ref="#/components/schemas/Appointement"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        return $this->sendResponse($appointement->toArray(), 'Appointement retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/appointements/{id}",
     *      summary="updateAppointement",
     *      tags={"Appointement"},
     *      description="Update Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Appointement")
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
     *                  ref="#/components/schemas/Appointement"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAppointementAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        $appointement = $this->appointementRepository->update($input, $id);

        return $this->sendResponse($appointement->toArray(), 'Appointement updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/appointements/{id}",
     *      summary="deleteAppointement",
     *      tags={"Appointement"},
     *      description="Delete Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
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
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        $appointement->delete();

        return $this->sendSuccess('Appointement deleted successfully');
    }

    public function getUserRdv()
    {

        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse([], 'L\'utilisateur doit être connecté');
        }

        $all = [];
        $appointments = Appointement::where('creator_id', $user->id)
            ->orWhere('user_id', $user->id)
            // ->orderBy(['created_at','DESC'])
            ->get();

        foreach ($appointments as $appointment) {
            if (!Carbon::parse($appointment->hour)->isPast()) {
                array_push($all, new AppointmentResource($appointment));
            }
        }

        if (empty($all)) {
            return $this->sendError("Aucun rendez-vous");
        }

        return $this->sendResponse($all, 'Liste des rendez-vous');
    }

    public function calculateFee($price)
    {
    }

    public function confirmRdv($idRdv)
    {
        $appointement = Appointement::find($idRdv);

        if (empty($appointement)) {
            return $this->sendError("Ce rdv n'existe pas");
        }

        $appointement->is_confirmed = !$appointement->is_confirmed;
        $appointement->save();

        return $this->sendResponse($appointement, "Mise à jour éffectué");
    }

    public function cancelRdv($idRdv)
    {
        $appointement = Appointement::find($idRdv);

        if (empty($appointement)) {
            return $this->sendError("Ce rdv n'existe pas");
        }

        $appointement->is_confirmed = !$appointement->is_confirmed;
        $appointement->save();

        return $this->sendResponse($appointement, "Mise à jour éffectué");
    }
}
