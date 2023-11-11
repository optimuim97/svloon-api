<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonAvailabilyAPIRequest;
use App\Http\Requests\API\UpdateSalonAvailabilyAPIRequest;
use App\Models\SalonAvailabily;
use App\Repositories\SalonAvailabilyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Salon;
use App\Models\StaffMember;
use Carbon\Carbon;

/**
 * Class SalonAvailabilyController
 */

class SalonAvailabilyAPIController extends AppBaseController
{
    private SalonAvailabilyRepository $salonAvailabilyRepository;

    public function __construct(SalonAvailabilyRepository $salonAvailabilyRepo)
    {
        $this->salonAvailabilyRepository = $salonAvailabilyRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-availabilies",
     *      summary="getSalonAvailabilyList",
     *      tags={"SalonAvailabily"},
     *      description="Get all SalonAvailabilies",
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
     *                  @OA\Items(ref="#/components/schemas/SalonAvailabily")
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
        $availabilies = [];

        $salonAvailabilies = $this->salonAvailabilyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        foreach ($salonAvailabilies as $item) {
        }

        return $this->sendResponse($availabilies, 'Salon Availabilies retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-availabilies",
     *      summary="createSalonAvailabily",
     *      tags={"SalonAvailabily"},
     *      description="Create SalonAvailabily",
     *      @OA\RequestBody(
     *        @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"date", "hour_start","hour_end","break_start","break_end"},
     *               @OA\Property(property="date", type="text"),
     *               @OA\Property(property="hour_start", type="text"),
     *               @OA\Property(property="hour_end", type="text"),
     *               @OA\Property(property="break_start", type="text"),
     *               @OA\Property(property="break_end", type="text")
     *            ),
     *        ),
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
     *                  ref="#/components/schemas/SalonAvailabily"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonAvailabilyAPIRequest $request): JsonResponse
    {
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse([], 'L\'utilisateur doit être connecté');
        }

        $input = $request->all();

        // $date = Carbon::parse($input['date'])->format('Y/m/d');
        $date = Carbon::parse($input['date'])->format('Y/m/d');
        $hour_start = $input['hour_start'];
        $hour_end = $input['hour_end'];

        $combinatedDateTimeStart = Carbon::parse("$date $hour_start");
        $combinatedDateTimeEnd = Carbon::parse("$date $hour_end");

        if ($combinatedDateTimeStart->isPast()) {
            return $this->sendError('Vous ne pouvez pas choisir une date de début passé');
        }

        // if($date->isPast($combinatedDateTimeStart)){
        //     return $this->sendError('Vous ne pouvez pas choisir une heure passé');
        // }

        if ($combinatedDateTimeEnd->isPast()) {
            return $this->sendError('Vous ne pouvez pas choisir une date de fin passé');
        }


        if ($combinatedDateTimeStart > $combinatedDateTimeEnd) {
            return $this->sendError('La date de début doit être inferieur à la date fin ');
        }


        $salonAvailabily = $this->salonAvailabilyRepository->create($input);

        return $this->sendResponse($salonAvailabily->toArray(), 'Disponibilité ajouté');
    }

    /**
     * @OA\Get(
     *      path="/salon-availabilies/{id}",
     *      summary="getSalonAvailabilyItem",
     *      tags={"SalonAvailabily"},
     *      description="Get SalonAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAvailabily",
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
     *                  ref="#/components/schemas/SalonAvailabily"
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
        /** @var SalonAvailabily $salonAvailabily */
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            return $this->sendError('Salon Availabily not found');
        }

        return $this->sendResponse($salonAvailabily->toArray(), 'Salon Availabily retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-availabilies/{id}",
     *      summary="updateSalonAvailabily",
     *      tags={"SalonAvailabily"},
     *      description="Update SalonAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAvailabily",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"date", "hour_start","hour_end","break_start","break_end"},
     *               @OA\Property(property="date", type="text"),
     *               @OA\Property(property="hour_start", type="text"),
     *               @OA\Property(property="hour_end", type="text"),
     *               @OA\Property(property="break_start", type="text"),
     *               @OA\Property(property="break_end", type="text")
     *            ),
     *        ),
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
     *                  ref="#/components/schemas/SalonAvailabily"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonAvailabilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonAvailabily $salonAvailabily */
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            return $this->sendError('Salon Availabily not found');
        }

        $salonAvailabily = $this->salonAvailabilyRepository->update($input, $id);

        return $this->sendResponse($salonAvailabily->toArray(), 'SalonAvailabily updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-availabilies/{id}",
     *      summary="deleteSalonAvailabily",
     *      tags={"SalonAvailabily"},
     *      description="Delete SalonAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAvailabily",
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
        /** @var SalonAvailabily $salonAvailabily */
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            return $this->sendError('Salon Availabily not found');
        }

        $salonAvailabily->delete();

        return $this->sendSuccess('Salon Availabily deleted successfully');
    }

    /**
     * @OA\Get(
     *      path="get-salon-availabilies/{id}",
     *      summary="updateSalonAvailabily",
     *      tags={"SalonAvailabily"},
     *      description="Update SalonAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAvailabily",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonAvailabily")
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
     *                  ref="#/components/schemas/SalonAvailabily"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getSalonAvailabilityById($salonId)
    {
        $availabilitiesActive  = [];

        $availabilities = SalonAvailabily::where("salon_id", $salonId)->first();

        if (empty($availabilities)) {
            return $this->sendError('Salon Availabily not found');
        }

        foreach ($availabilities as $key => $value) {
            if (!(Carbon::parse($value->hour_end)->isPast()) && !(Carbon::parse($value->date)->isPast())) {
                array_push($availabilitiesActive, $value);
            }
        }

        return $this->sendResponse($availabilitiesActive, 'SalonAvailabily updated successfully');
    }

    public function getUserAvailabilities()
    {

        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse([], 'L\'utilisateur doit être connecté');
        }

        if ($user->userType == "salon") {
            return $this->sendResponse([], 'L\'utilisateur doit être de type salon');
        }

        //TODO salon must have unqiue names
        $salons = $user->salons;

        if (count($salons) > 1) {
            return $this->sendError("L'utilisateur a plusieurs salon, choisissez par le nom du Salon");
        }

        $all = [];
        $availabilies = SalonAvailabily::where('salon_id', $salons->first()->id)
            ->get();

        foreach ($availabilies as $salon_availabiltie) {
            if (!Carbon::parse($salon_availabiltie->hour_start)->isPast()) {
                array_push($all, $salon_availabiltie);
            }
        }

        if (empty($all)) {
            return $this->sendError("Aucune disponibilité enregistré");
        }

        return $this->sendResponse($all, 'Liste des disponibilité enregistré');
    }

    public function getStaffMembers()
    {

        $user = auth("api")->user();
        $staffMember = [];

        if (empty($user)) {
            return $this->sendResponse([], 'L\'utilisateur doit être connecté');
        }

        if ($user->userType == "salon") {
            return $this->sendResponse([], 'L\'utilisateur doit être de type salon');
        }

        $salons = $user->salons;

        if($salons->count() > 1){
            foreach ($salons as $salon) {
                // dd($salon);
                array_push($staffMember,$salon->staff);
            }

            return $this->sendResponse($staffMember, "Liste de membre du staff");
        }

        // dd($salons->first()->staff);

        return $this->sendResponse($salons->first()->staff, "Liste de membre du staff");
    }
}
