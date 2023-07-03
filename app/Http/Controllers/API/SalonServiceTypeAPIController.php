<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonServiceTypeAPIRequest;
use App\Http\Requests\API\UpdateSalonServiceTypeAPIRequest;
use App\Models\SalonServiceType;
use App\Repositories\SalonServiceTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonServiceTypeController
 */

class SalonServiceTypeAPIController extends AppBaseController
{
    private SalonServiceTypeRepository $salonServiceTypeRepository;

    public function __construct(SalonServiceTypeRepository $salonServiceTypeRepo)
    {
        $this->salonServiceTypeRepository = $salonServiceTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-service-types",
     *      summary="getSalonServiceTypeList",
     *      tags={"SalonServiceType"},
     *      description="Get all SalonServiceTypes",
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
     *                  @OA\Items(ref="#/components/schemas/SalonServiceType")
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
        $salonServiceTypes = $this->salonServiceTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonServiceTypes->toArray(), 'Salon Service Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-service-types",
     *      summary="createSalonServiceType",
     *      tags={"SalonServiceType"},
     *      description="Create SalonServiceType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonServiceType")
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
     *                  ref="#/components/schemas/SalonServiceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonServiceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salonServiceType = $this->salonServiceTypeRepository->create($input);

        return $this->sendResponse($salonServiceType->toArray(), 'Salon Service Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-service-types/{id}",
     *      summary="getSalonServiceTypeItem",
     *      tags={"SalonServiceType"},
     *      description="Get SalonServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonServiceType",
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
     *                  ref="#/components/schemas/SalonServiceType"
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
        /** @var SalonServiceType $salonServiceType */
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            return $this->sendError('Salon Service Type not found');
        }

        return $this->sendResponse($salonServiceType->toArray(), 'Salon Service Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-service-types/{id}",
     *      summary="updateSalonServiceType",
     *      tags={"SalonServiceType"},
     *      description="Update SalonServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonServiceType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonServiceType")
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
     *                  ref="#/components/schemas/SalonServiceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonServiceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonServiceType $salonServiceType */
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            return $this->sendError('Salon Service Type not found');
        }

        $salonServiceType = $this->salonServiceTypeRepository->update($input, $id);

        return $this->sendResponse($salonServiceType->toArray(), 'SalonServiceType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-service-types/{id}",
     *      summary="deleteSalonServiceType",
     *      tags={"SalonServiceType"},
     *      description="Delete SalonServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonServiceType",
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
        /** @var SalonServiceType $salonServiceType */
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            return $this->sendError('Salon Service Type not found');
        }

        $salonServiceType->delete();

        return $this->sendSuccess('Salon Service Type deleted successfully');
    }
}
