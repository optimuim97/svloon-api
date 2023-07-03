<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServicePlaceTypeAPIRequest;
use App\Http\Requests\API\UpdateServicePlaceTypeAPIRequest;
use App\Models\ServicePlaceType;
use App\Repositories\ServicePlaceTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ServicePlaceTypeController
 */

class ServicePlaceTypeAPIController extends AppBaseController
{
    private ServicePlaceTypeRepository $servicePlaceTypeRepository;

    public function __construct(ServicePlaceTypeRepository $servicePlaceTypeRepo)
    {
        $this->servicePlaceTypeRepository = $servicePlaceTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/service-place-types",
     *      summary="getServicePlaceTypeList",
     *      tags={"ServicePlaceType"},
     *      description="Get all ServicePlaceTypes",
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
     *                  @OA\Items(ref="#/components/schemas/ServicePlaceType")
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
        $servicePlaceTypes = $this->servicePlaceTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($servicePlaceTypes->toArray(), 'Service Place Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/service-place-types",
     *      summary="createServicePlaceType",
     *      tags={"ServicePlaceType"},
     *      description="Create ServicePlaceType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServicePlaceType")
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
     *                  ref="#/components/schemas/ServicePlaceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServicePlaceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $servicePlaceType = $this->servicePlaceTypeRepository->create($input);

        return $this->sendResponse($servicePlaceType->toArray(), 'Service Place Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/service-place-types/{id}",
     *      summary="getServicePlaceTypeItem",
     *      tags={"ServicePlaceType"},
     *      description="Get ServicePlaceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicePlaceType",
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
     *                  ref="#/components/schemas/ServicePlaceType"
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
        /** @var ServicePlaceType $servicePlaceType */
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            return $this->sendError('Service Place Type not found');
        }

        return $this->sendResponse($servicePlaceType->toArray(), 'Service Place Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/service-place-types/{id}",
     *      summary="updateServicePlaceType",
     *      tags={"ServicePlaceType"},
     *      description="Update ServicePlaceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicePlaceType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServicePlaceType")
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
     *                  ref="#/components/schemas/ServicePlaceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServicePlaceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ServicePlaceType $servicePlaceType */
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            return $this->sendError('Service Place Type not found');
        }

        $servicePlaceType = $this->servicePlaceTypeRepository->update($input, $id);

        return $this->sendResponse($servicePlaceType->toArray(), 'ServicePlaceType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/service-place-types/{id}",
     *      summary="deleteServicePlaceType",
     *      tags={"ServicePlaceType"},
     *      description="Delete ServicePlaceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicePlaceType",
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
        /** @var ServicePlaceType $servicePlaceType */
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            return $this->sendError('Service Place Type not found');
        }

        $servicePlaceType->delete();

        return $this->sendSuccess('Service Place Type deleted successfully');
    }
}
