<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBankInfoAPIRequest;
use App\Http\Requests\API\UpdateBankInfoAPIRequest;
use App\Models\BankInfo;
use App\Repositories\BankInfoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BankInfoController
 */

class BankInfoAPIController extends AppBaseController
{
    private BankInfoRepository $bankInfoRepository;

    public function __construct(BankInfoRepository $bankInfoRepo)
    {
        $this->bankInfoRepository = $bankInfoRepo;
    }

    /**
     * @OA\Get(
     *      path="/bank-infos",
     *      summary="getBankInfoList",
     *      tags={"BankInfo"},
     *      description="Get all BankInfos",
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
     *                  @OA\Items(ref="#/components/schemas/BankInfo")
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
        $bankInfos = $this->bankInfoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bankInfos->toArray(), 'Bank Infos retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/bank-infos",
     *      summary="createBankInfo",
     *      tags={"BankInfo"},
     *      description="Create BankInfo",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BankInfo")
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
     *                  ref="#/components/schemas/BankInfo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBankInfoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $bankInfo = $this->bankInfoRepository->create($input);

        return $this->sendResponse($bankInfo->toArray(), 'Bank Info saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/bank-infos/{id}",
     *      summary="getBankInfoItem",
     *      tags={"BankInfo"},
     *      description="Get BankInfo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BankInfo",
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
     *                  ref="#/components/schemas/BankInfo"
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
        /** @var BankInfo $bankInfo */
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            return $this->sendError('Bank Info not found');
        }

        return $this->sendResponse($bankInfo->toArray(), 'Bank Info retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/bank-infos/{id}",
     *      summary="updateBankInfo",
     *      tags={"BankInfo"},
     *      description="Update BankInfo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BankInfo",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/BankInfo")
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
     *                  ref="#/components/schemas/BankInfo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBankInfoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BankInfo $bankInfo */
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            return $this->sendError('Bank Info not found');
        }

        $bankInfo = $this->bankInfoRepository->update($input, $id);

        return $this->sendResponse($bankInfo->toArray(), 'BankInfo updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/bank-infos/{id}",
     *      summary="deleteBankInfo",
     *      tags={"BankInfo"},
     *      description="Delete BankInfo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of BankInfo",
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
        /** @var BankInfo $bankInfo */
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            return $this->sendError('Bank Info not found');
        }

        $bankInfo->delete();

        return $this->sendSuccess('Bank Info deleted successfully');
    }
}
