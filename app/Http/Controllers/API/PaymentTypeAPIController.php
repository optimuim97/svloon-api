<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentTypeAPIRequest;
use App\Http\Requests\API\UpdatePaymentTypeAPIRequest;
use App\Models\PaymentType;
use App\Repositories\PaymentTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PaymentTypeController
 */

class PaymentTypeAPIController extends AppBaseController
{
    private PaymentTypeRepository $paymentTypeRepository;

    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->paymentTypeRepository = $paymentTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/payment-types",
     *      summary="getPaymentTypeList",
     *      tags={"PaymentType"},
     *      description="Get all PaymentTypes",
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
     *                  @OA\Items(ref="#/components/schemas/PaymentType")
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
        $paymentTypes = $this->paymentTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paymentTypes->toArray(), 'Payment Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/payment-types",
     *      summary="createPaymentType",
     *      tags={"PaymentType"},
     *      description="Create PaymentType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PaymentType")
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
     *                  ref="#/components/schemas/PaymentType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaymentTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $paymentType = $this->paymentTypeRepository->create($input);

        return $this->sendResponse($paymentType->toArray(), 'Payment Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/payment-types/{id}",
     *      summary="getPaymentTypeItem",
     *      tags={"PaymentType"},
     *      description="Get PaymentType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentType",
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
     *                  ref="#/components/schemas/PaymentType"
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
        /** @var PaymentType $paymentType */
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            return $this->sendError('Payment Type not found');
        }

        return $this->sendResponse($paymentType->toArray(), 'Payment Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/payment-types/{id}",
     *      summary="updatePaymentType",
     *      tags={"PaymentType"},
     *      description="Update PaymentType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/PaymentType")
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
     *                  ref="#/components/schemas/PaymentType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaymentTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PaymentType $paymentType */
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            return $this->sendError('Payment Type not found');
        }

        $paymentType = $this->paymentTypeRepository->update($input, $id);

        return $this->sendResponse($paymentType->toArray(), 'PaymentType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/payment-types/{id}",
     *      summary="deletePaymentType",
     *      tags={"PaymentType"},
     *      description="Delete PaymentType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PaymentType",
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
        /** @var PaymentType $paymentType */
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            return $this->sendError('Payment Type not found');
        }

        $paymentType->delete();

        return $this->sendSuccess('Payment Type deleted successfully');
    }
}
