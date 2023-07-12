<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuickServiceAPIRequest;
use App\Http\Requests\API\UpdateQuickServiceAPIRequest;
use App\Models\QuickService;
use App\Repositories\QuickServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class QuickServiceController
 */

class QuickServiceAPIController extends AppBaseController
{
    private QuickServiceRepository $quickServiceRepository;

    public function __construct(QuickServiceRepository $quickServiceRepo)
    {
        $this->quickServiceRepository = $quickServiceRepo;
    }

    /**
     * @OA\Get(
     *      path="/quick-services",
     *      summary="getQuickServiceList",
     *      tags={"QuickService"},
     *      description="Get all QuickServices",
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
     *                  @OA\Items(ref="#/components/schemas/QuickService")
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
        $quickServices = $this->quickServiceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($quickServices->toArray(), 'Quick Services retrieved successfully');
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
     *              @OA\Property(property="payment_method_id", type="integer"),
     *              @OA\Property(property="payment_method_type_id", type="integer"),
     *              @OA\Property(property="duration", type="string"),
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
    public function requestQuickService(CreateQuickServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $user = auth('api')->users;
        $input ["user_id"] = $user->id;

        $request->validate(QuickService::$rules);

        $quickService = $this->quickServiceRepository->create($input);

        return $this->sendResponse($quickService->toArray(), 'Quick Service saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/quick-services/{id}",
     *      summary="getQuickServiceItem",
     *      tags={"QuickService"},
     *      description="Get QuickService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of QuickService",
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
    public function show($id): JsonResponse
    {
        /** @var QuickService $quickService */
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            return $this->sendError('Quick Service not found');
        }

        return $this->sendResponse($quickService->toArray(), 'Quick Service retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/quick-services/{id}",
     *      summary="updateQuickService",
     *      tags={"QuickService"},
     *      description="Update QuickService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of QuickService",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/QuickService")
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
    public function update($id, UpdateQuickServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var QuickService $quickService */
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            return $this->sendError('Quick Service not found');
        }

        $quickService = $this->quickServiceRepository->update($input, $id);

        return $this->sendResponse($quickService->toArray(), 'QuickService updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/quick-services/{id}",
     *      summary="deleteQuickService",
     *      tags={"QuickService"},
     *      description="Delete QuickService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of QuickService",
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
        /** @var QuickService $quickService */
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            return $this->sendError('Quick Service not found');
        }

        $quickService->delete();

        return $this->sendSuccess('Quick Service deleted successfully');
    }
}
