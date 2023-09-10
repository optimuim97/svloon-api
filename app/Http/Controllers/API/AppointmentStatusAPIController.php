<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAppointmentStatusAPIRequest;
use App\Http\Requests\API\UpdateAppointmentStatusAPIRequest;
use App\Models\AppointmentStatus;
use App\Repositories\AppointmentStatusRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AppointmentStatusController
 */

class AppointmentStatusAPIController extends AppBaseController
{
    private AppointmentStatusRepository $appointmentStatusRepository;

    public function __construct(AppointmentStatusRepository $appointmentStatusRepo)
    {
        $this->appointmentStatusRepository = $appointmentStatusRepo;
    }

    /**
     * @OA\Get(
     *      path="/appointment-statuses",
     *      summary="getAppointmentStatusList",
     *      tags={"AppointmentStatus"},
     *      description="Get all AppointmentStatuses",
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
     *                  @OA\Items(ref="#/components/schemas/AppointmentStatus")
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
        $appointment - statuses = $this->appointmentStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appointment - statuses->toArray(), 'Appointment Statuses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/appointment-statuses",
     *      summary="createAppointmentStatus",
     *      tags={"AppointmentStatus"},
     *      description="Create AppointmentStatus",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AppointmentStatus")
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
     *                  ref="#/components/schemas/AppointmentStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAppointmentStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $appointmentStatus = $this->appointmentStatusRepository->create($input);

        return $this->sendResponse($appointmentStatus->toArray(), 'Appointment Status saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/appointment-statuses/{id}",
     *      summary="getAppointmentStatusItem",
     *      tags={"AppointmentStatus"},
     *      description="Get AppointmentStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AppointmentStatus",
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
     *                  ref="#/components/schemas/AppointmentStatus"
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
        /** @var AppointmentStatus $appointmentStatus */
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            return $this->sendError('Appointment Status not found');
        }

        return $this->sendResponse($appointmentStatus->toArray(), 'Appointment Status retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/appointment-statuses/{id}",
     *      summary="updateAppointmentStatus",
     *      tags={"AppointmentStatus"},
     *      description="Update AppointmentStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AppointmentStatus",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AppointmentStatus")
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
     *                  ref="#/components/schemas/AppointmentStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAppointmentStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AppointmentStatus $appointmentStatus */
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            return $this->sendError('Appointment Status not found');
        }

        $appointmentStatus = $this->appointmentStatusRepository->update($input, $id);

        return $this->sendResponse($appointmentStatus->toArray(), 'AppointmentStatus updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/appointment-statuses/{id}",
     *      summary="deleteAppointmentStatus",
     *      tags={"AppointmentStatus"},
     *      description="Delete AppointmentStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AppointmentStatus",
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
        /** @var AppointmentStatus $appointmentStatus */
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            return $this->sendError('Appointment Status not found');
        }

        $appointmentStatus->delete();

        return $this->sendSuccess('Appointment Status deleted successfully');
    }
}
