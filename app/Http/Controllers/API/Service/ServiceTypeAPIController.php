<?php

namespace App\Http\Controllers\API\Service;

use App\Http\Requests\API\CreateServiceTypeAPIRequest;
use App\Http\Requests\API\UpdateServiceTypeAPIRequest;
use App\Models\ServiceType;
use App\Repositories\ServiceTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Str;
/**
 * Class ServiceTypeController
 */

class ServiceTypeAPIController extends AppBaseController
{
    private ServiceTypeRepository $serviceTypeRepository;

    public function __construct(ServiceTypeRepository $serviceTypeRepo)
    {
        $this->serviceTypeRepository = $serviceTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/service-types",
     *      summary="getServiceTypeList",
     *      tags={"ServiceType"},
     *      description="Get all ServiceTypes",
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
     *                  @OA\Items(ref="#/components/schemas/ServiceType")
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
        $serviceTypes = $this->serviceTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($serviceTypes->toArray(), 'Service Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/service-types",
     *      summary="createServiceType",
     *      tags={"ServiceType"},
     *      description="Create ServiceType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceType")
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
     *                  ref="#/components/schemas/ServiceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServiceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        if (!empty($input['image_url'])) {
            $url = (new ServiceType())->upload($request, 'image_url');
            $input['image_url'] = $url;
            $input['slug'] = Str::slug($input['label']);
        }

        $serviceType = $this->serviceTypeRepository->create($input);

        return $this->sendResponse($serviceType->toArray(), 'Service Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/service-types/{id}",
     *      summary="getServiceTypeItem",
     *      tags={"ServiceType"},
     *      description="Get ServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceType",
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
     *                  ref="#/components/schemas/ServiceType"
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
        /** @var ServiceType $serviceType */
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            return $this->sendError('Service Type not found');
        }

        return $this->sendResponse($serviceType->toArray(), 'Service Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/service-types/{id}",
     *      summary="updateServiceType",
     *      tags={"ServiceType"},
     *      description="Update ServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceType")
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
     *                  ref="#/components/schemas/ServiceType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServiceTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ServiceType $serviceType */
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            return $this->sendError('Service Type not found');
        }

        if (!empty($input['image_url'])) {
            $url = (new ServiceType())->upload($request, 'image_url');
            $input['image_url'] = $url;
        } else {
            $input['image_url'] = $serviceType->image_url;
        }


        $serviceType = $this->serviceTypeRepository->update($input, $id);

        return $this->sendResponse($serviceType->toArray(), 'ServiceType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/service-types/{id}",
     *      summary="deleteServiceType",
     *      tags={"ServiceType"},
     *      description="Delete ServiceType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceType",
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
        /** @var ServiceType $serviceType */
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            return $this->sendError('Service Type not found');
        }

        $serviceType->delete();

        return $this->sendSuccess('Service Type deleted successfully');
    }
}
