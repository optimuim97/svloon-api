<?php

namespace App\Http\Controllers\API\Salon;

use App\Http\Requests\API\CreateSalonScheduleAPIRequest;
use App\Http\Requests\API\UpdateSalonScheduleAPIRequest;
use App\Models\SalonSchedule;
use App\Repositories\SalonScheduleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonScheduleController
 */

class SalonScheduleAPIController extends AppBaseController
{
    private SalonScheduleRepository $salonScheduleRepository;

    public function __construct(SalonScheduleRepository $salonScheduleRepo)
    {
        $this->salonScheduleRepository = $salonScheduleRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-schedules",
     *      summary="getSalonScheduleList",
     *      tags={"SalonSchedule"},
     *      description="Get all SalonSchedules",
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
     *                  @OA\Items(ref="#/components/schemas/SalonSchedule")
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
        $salonSchedules = $this->salonScheduleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonSchedules->toArray(), 'Salon Schedules retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-schedules",
     *      summary="createSalonSchedule",
     *      tags={"SalonSchedule"},
     *      description="Create SalonSchedule",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonSchedule")
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
     *                  ref="#/components/schemas/SalonSchedule"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonScheduleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salonSchedule = $this->salonScheduleRepository->create($input);

        return $this->sendResponse($salonSchedule->toArray(), 'Salon Schedule saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-schedules/{id}",
     *      summary="getSalonScheduleItem",
     *      tags={"SalonSchedule"},
     *      description="Get SalonSchedule",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonSchedule",
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
     *                  ref="#/components/schemas/SalonSchedule"
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
        /** @var SalonSchedule $salonSchedule */
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            return $this->sendError('Salon Schedule not found');
        }

        return $this->sendResponse($salonSchedule->toArray(), 'Salon Schedule retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-schedules/{id}",
     *      summary="updateSalonSchedule",
     *      tags={"SalonSchedule"},
     *      description="Update SalonSchedule",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonSchedule",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonSchedule")
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
     *                  ref="#/components/schemas/SalonSchedule"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonScheduleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonSchedule $salonSchedule */
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            return $this->sendError('Salon Schedule not found');
        }

        $salonSchedule = $this->salonScheduleRepository->update($input, $id);

        return $this->sendResponse($salonSchedule->toArray(), 'SalonSchedule updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-schedules/{id}",
     *      summary="deleteSalonSchedule",
     *      tags={"SalonSchedule"},
     *      description="Delete SalonSchedule",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonSchedule",
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
        /** @var SalonSchedule $salonSchedule */
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            return $this->sendError('Salon Schedule not found');
        }

        $salonSchedule->delete();

        return $this->sendSuccess('Salon Schedule deleted successfully');
    }
}
