<?php

namespace App\Http\Controllers\API\Salon;

use App\Http\Requests\API\CreateSalonTypeAccountAPIRequest;
use App\Http\Requests\API\UpdateSalonTypeAccountAPIRequest;
use App\Models\SalonTypeAccount;
use App\Repositories\SalonTypeAccountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonTypeAccountController
 */

class SalonTypeAccountAPIController extends AppBaseController
{
    private SalonTypeAccountRepository $salonTypeAccountRepository;

    public function __construct(SalonTypeAccountRepository $salonTypeAccountRepo)
    {
        $this->salonTypeAccountRepository = $salonTypeAccountRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-type-accounts",
     *      summary="getSalonTypeAccountList",
     *      tags={"SalonTypeAccount"},
     *      description="Get all SalonTypeAccounts",
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
     *                  @OA\Items(ref="#/components/schemas/SalonTypeAccount")
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
        $salonTypeAccounts = $this->salonTypeAccountRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonTypeAccounts->toArray(), 'Salon Type Accounts retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-type-accounts",
     *      summary="createSalonTypeAccount",
     *      tags={"SalonTypeAccount"},
     *      description="Create SalonTypeAccount",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonTypeAccount")
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
     *                  ref="#/components/schemas/SalonTypeAccount"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonTypeAccountAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salonTypeAccount = $this->salonTypeAccountRepository->create($input);

        return $this->sendResponse($salonTypeAccount->toArray(), 'Salon Type Account saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-type-accounts/{id}",
     *      summary="getSalonTypeAccountItem",
     *      tags={"SalonTypeAccount"},
     *      description="Get SalonTypeAccount",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonTypeAccount",
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
     *                  ref="#/components/schemas/SalonTypeAccount"
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
        /** @var SalonTypeAccount $salonTypeAccount */
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            return $this->sendError('Salon Type Account not found');
        }

        return $this->sendResponse($salonTypeAccount->toArray(), 'Salon Type Account retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-type-accounts/{id}",
     *      summary="updateSalonTypeAccount",
     *      tags={"SalonTypeAccount"},
     *      description="Update SalonTypeAccount",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonTypeAccount",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonTypeAccount")
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
     *                  ref="#/components/schemas/SalonTypeAccount"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonTypeAccountAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonTypeAccount $salonTypeAccount */
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            return $this->sendError('Salon Type Account not found');
        }

        $salonTypeAccount = $this->salonTypeAccountRepository->update($input, $id);

        return $this->sendResponse($salonTypeAccount->toArray(), 'SalonTypeAccount updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-type-accounts/{id}",
     *      summary="deleteSalonTypeAccount",
     *      tags={"SalonTypeAccount"},
     *      description="Delete SalonTypeAccount",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonTypeAccount",
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
        /** @var SalonTypeAccount $salonTypeAccount */
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            return $this->sendError('Salon Type Account not found');
        }

        $salonTypeAccount->delete();

        return $this->sendSuccess('Salon Type Account deleted successfully');
    }
}
