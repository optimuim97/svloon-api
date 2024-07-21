<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAddressAPIRequest;
use App\Http\Requests\API\UpdateUserAddressAPIRequest;
use App\Models\UserAddress;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class UserAddressController
 */

class UserAddressAPIController extends AppBaseController
{
    private UserAddressRepository $userAddressRepository;

    public function __construct(UserAddressRepository $userAddressRepo)
    {
        $this->userAddressRepository = $userAddressRepo;
    }

    /**
     * @OA\Get(
     *      path="/user-addresses",
     *      summary="getUserAddressList",
     *      tags={"UserAddress"},
     *      description="Get all UserAddresses",
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
     *                  @OA\Items(ref="#/components/schemas/UserAddress")
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
        $userAddresses = $this->userAddressRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userAddresses->toArray(), 'User Addresses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/user-addresses",
     *      summary="createUserAddress",
     *      tags={"UserAddress"},
     *      description="Create UserAddress",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserAddress")
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
     *                  ref="#/components/schemas/UserAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $userAddress = $this->userAddressRepository->create($input);

        return $this->sendResponse($userAddress->toArray(), 'User Address saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/user-addresses/{id}",
     *      summary="getUserAddressItem",
     *      tags={"UserAddress"},
     *      description="Get UserAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserAddress",
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
     *                  ref="#/components/schemas/UserAddress"
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
        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            return $this->sendError('User Address not found');
        }

        return $this->sendResponse($userAddress->toArray(), 'User Address retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/user-addresses/{id}",
     *      summary="updateUserAddress",
     *      tags={"UserAddress"},
     *      description="Update UserAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserAddress",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserAddress")
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
     *                  ref="#/components/schemas/UserAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            return $this->sendError('User Address not found');
        }

        $userAddress = $this->userAddressRepository->update($input, $id);

        return $this->sendResponse($userAddress->toArray(), 'UserAddress updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/user-addresses/{id}",
     *      summary="deleteUserAddress",
     *      tags={"UserAddress"},
     *      description="Delete UserAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserAddress",
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
        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            return $this->sendError('User Address not found');
        }

        $userAddress->delete();

        return $this->sendSuccess('User Address deleted successfully');
    }
}
