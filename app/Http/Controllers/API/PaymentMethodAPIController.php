<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentMethodAPIRequest;
use App\Http\Requests\API\UpdatePaymentMethodAPIRequest;
use App\Models\PaymentMethod;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PaymentMethodController
 */

class PaymentMethodAPIController extends AppBaseController
{
    private PaymentMethodRepository $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentMethodRepository = $paymentMethodRepo;
    }

    /**
     * @OA\Get(
     *      path="/payment-methods",
     *      summary="getPaymentMethodList",
     *      tags={"PaymentMethod"},
     *      description="Get all PaymentMethods",
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
     *                  @OA\Items(ref="#/components/schemas/PaymentMethod")
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
        $paymentMethods = $this->paymentMethodRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paymentMethods->toArray(), 'Payment Methods retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/payment-methods",
     *      summary="createPaymentMethod",
     *      tags={"PaymentMethod"},
     *      description="Create PaymentMethod",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PaymentMethod")
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
     *                  ref="#/components/schemas/PaymentMethod"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaymentMethodAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $paymentMethod = $this->paymentMethodRepository->create($input);

        return $this->sendResponse($paymentMethod->toArray(), 'Payment Method saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/payment-methods/{id}",
     *      summary="getPaymentMethodItem",
     *      tags={"PaymentMethod"},
     *      description="Get PaymentMethod",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentMethod",
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
     *                  ref="#/components/schemas/PaymentMethod"
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
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            return $this->sendError('Payment Method not found');
        }

        return $this->sendResponse($paymentMethod->toArray(), 'Payment Method retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/payment-methods/{id}",
     *      summary="updatePaymentMethod",
     *      tags={"PaymentMethod"},
     *      description="Update PaymentMethod",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentMethod",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PaymentMethod")
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
     *                  ref="#/components/schemas/PaymentMethod"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaymentMethodAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            return $this->sendError('Payment Method not found');
        }

        $paymentMethod = $this->paymentMethodRepository->update($input, $id);

        return $this->sendResponse($paymentMethod->toArray(), 'PaymentMethod updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/payment-methods/{id}",
     *      summary="deletePaymentMethod",
     *      tags={"PaymentMethod"},
     *      description="Delete PaymentMethod",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentMethod",
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
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            return $this->sendError('Payment Method not found');
        }

        $paymentMethod->delete();

        return $this->sendSuccess('Payment Method deleted successfully');
    }
}
