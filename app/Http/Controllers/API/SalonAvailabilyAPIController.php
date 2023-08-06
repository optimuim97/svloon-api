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

        foreach($salonAvailabilies as $item){
            
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
        $input = $request->all();
        
        $salonAvailabily = $this->salonAvailabilyRepository->create($input);

        return $this->sendResponse($salonAvailabily->toArray(), 'Salon Availabily saved successfully');
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
    public function getSalonAvailabilityById($salonId){
        $availabilitiesActive  = [];

        $availabilities = SalonAvailabily::where("salon_id", $salonId)->first();

        if (empty($availabilities)) {
            return $this->sendError('Salon Availabily not found');
        }

        foreach ($availabilities as $key => $value) {
            if(!(Carbon::parse($value->hour_end)->isPast()) && !(Carbon::parse($value->date)->isPast())){
                array_push($availabilitiesActive, $value);
            }
        }

        return $this->sendResponse($availabilitiesActive, 'SalonAvailabily updated successfully');

    }
}
