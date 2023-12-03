<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderStatusAPIRequest;
use App\Http\Requests\API\UpdateOrderStatusAPIRequest;
use App\Models\OrderStatus;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Str;

/**
 * Class OrderStatusController
 */

class OrderStatusAPIController extends AppBaseController
{
    private OrderStatusRepository $orderStatusRepository;

    public function __construct(OrderStatusRepository $orderStatusRepo)
    {
        $this->orderStatusRepository = $orderStatusRepo;
    }

    /**
     * @OA\Get(
     *      path="/order-statuses",
     *      summary="getOrderStatusList",
     *      tags={"OrderStatus"},
     *      description="Get all OrderStatuses",
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
     *                  @OA\Items(ref="#/components/schemas/OrderStatus")
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
        $orderStatuses = $this->orderStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderStatuses->toArray(), 'Order Statuses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/order-statuses",
     *      summary="createOrderStatus",
     *      tags={"OrderStatus"},
     *      description="Create OrderStatus",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/OrderStatus")
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
     *                  ref="#/components/schemas/OrderStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['label']);

        $orderStatus = $this->orderStatusRepository->create($input);

        return $this->sendResponse($orderStatus->toArray(), 'Order Status saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/order-statuses/{id}",
     *      summary="getOrderStatusItem",
     *      tags={"OrderStatus"},
     *      description="Get OrderStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of OrderStatus",
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
     *                  ref="#/components/schemas/OrderStatus"
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
        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        return $this->sendResponse($orderStatus->toArray(), 'Order Status retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/order-statuses/{id}",
     *      summary="updateOrderStatus",
     *      tags={"OrderStatus"},
     *      description="Update OrderStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of OrderStatus",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/OrderStatus")
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
     *                  ref="#/components/schemas/OrderStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        $orderStatus = $this->orderStatusRepository->update($input, $id);

        return $this->sendResponse($orderStatus->toArray(), 'OrderStatus updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/order-statuses/{id}",
     *      summary="deleteOrderStatus",
     *      tags={"OrderStatus"},
     *      description="Delete OrderStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of OrderStatus",
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
        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        $orderStatus->delete();

        return $this->sendSuccess('Order Status deleted successfully');
    }
}
