<?php

namespace App\Http\Controllers\API\Salon;

use App\Http\Requests\API\CreateSalonUnAvailabilyAPIRequest;
use App\Http\Requests\API\UpdateSalonUnAvailabilyAPIRequest;
use App\Models\SalonUnAvailabily;
use App\Repositories\SalonUnAvailabilyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;

/**
 * Class SalonUnAvailabilyController
 */

class SalonUnAvailabilyAPIController extends AppBaseController
{
    private SalonUnAvailabilyRepository $salonUnAvailabilyRepository;

    public function __construct(SalonUnAvailabilyRepository $salonUnAvailabilyRepo)
    {
        $this->salonUnAvailabilyRepository = $salonUnAvailabilyRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-un-availabilies",
     *      summary="getSalonUnAvailabilyList",
     *      tags={"SalonUnAvailabily"},
     *      description="Get all SalonUnAvailabilies",
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
     *                  @OA\Items(ref="#/components/schemas/SalonUnAvailabily")
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
        $salonUnAvailabilies = $this->salonUnAvailabilyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonUnAvailabilies->toArray(), 'Salon Un Availabilies retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-un-availabilies",
     *      summary="createSalonUnAvailabily",
     *      tags={"SalonUnAvailabily"},
     *      description="Create SalonUnAvailabily",
     *      @OA\RequestBody(
     *        @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"date", "hour_start","hour_end","raison"},
     *               @OA\Property(property="date", type="text"),
     *               @OA\Property(property="hour_start", type="text"),
     *               @OA\Property(property="hour_end", type="text"),
     *               @OA\Property(property="raison", type="text"),
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
     *                  ref="#/components/schemas/SalonUnAvailabily"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonUnAvailabilyAPIRequest $request): JsonResponse
    {
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse([],'L\'utilisateur doit être connecté');
        }

        if (!$user?->userType?->slug =="salon") {
            return $this->sendResponse([],'Doit être un salon');
        }

        $input = $request->all();

        $date =$input['date'];
        $hour =$input['hour_start'];

        $input["salon_id"] = $user->salons->first()->id;

        $combinatedDateTime = Carbon::parse("$date $hour");

        if($combinatedDateTime->isPast()){
            return $this->sendError('Vous ne pouvez pas choisir une date passé');
        }


        $salonUnAvailabily = $this->salonUnAvailabilyRepository->create($input);

        return $this->sendResponse($salonUnAvailabily->toArray(), 'Indisponibilité ajouté avec succès');
    }

    /**
     * @OA\Get(
     *      path="/salon-un-availabilies/{id}",
     *      summary="getSalonUnAvailabilyItem",
     *      tags={"SalonUnAvailabily"},
     *      description="Get SalonUnAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonUnAvailabily",
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
     *                  ref="#/components/schemas/SalonUnAvailabily"
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
        /** @var SalonUnAvailabily $salonUnAvailabily */
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            return $this->sendError('Salon Un Availabily not found');
        }

        return $this->sendResponse($salonUnAvailabily->toArray(), 'Salon Un Availabily retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-un-availabilies/{id}",
     *      summary="updateSalonUnAvailabily",
     *      tags={"SalonUnAvailabily"},
     *      description="Update SalonUnAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonUnAvailabily",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *       @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"date", "hour_start","hour_end","raison"},
     *               @OA\Property(property="date", type="text"),
     *               @OA\Property(property="hour_start", type="text"),
     *               @OA\Property(property="hour_end", type="text"),
     *               @OA\Property(property="raison", type="text"),
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
     *                  ref="#/components/schemas/SalonUnAvailabily"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonUnAvailabilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonUnAvailabily $salonUnAvailabily */
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            return $this->sendError('Salon Un Availabily not found');
        }

        $salonUnAvailabily = $this->salonUnAvailabilyRepository->update($input, $id);

        return $this->sendResponse($salonUnAvailabily->toArray(), 'SalonUnAvailabily updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-un-availabilies/{id}",
     *      summary="deleteSalonUnAvailabily",
     *      tags={"SalonUnAvailabily"},
     *      description="Delete SalonUnAvailabily",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonUnAvailabily",
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
        /** @var SalonUnAvailabily $salonUnAvailabily */
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            return $this->sendError('Salon Un Availabily not found');
        }

        $salonUnAvailabily->delete();

        return $this->sendSuccess('Salon Un Availabily deleted successfully');
    }
}
