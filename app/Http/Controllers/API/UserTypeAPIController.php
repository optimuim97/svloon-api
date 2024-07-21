<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserTypeAPIRequest;
use App\Http\Requests\API\UpdateUserTypeAPIRequest;
use App\Models\UserType;
use App\Repositories\UserTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class UserTypeController
 */
class UserTypeAPIController extends AppBaseController
{
    private UserTypeRepository $userTypeRepository;

    public function __construct(UserTypeRepository $userTypeRepo)
    {
        $this->userTypeRepository = $userTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/user-types",
     *      summary="getUserTypeList",
     *      tags={"UserType"},
     *      description="Get all UserTypes",
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
     *                  @OA\Items(ref="#/components/schemas/UserType")
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
        $userTypes = $this->userTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userTypes->toArray(), 'User Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/user-types",
     *      summary="createUserType",
     *      tags={"UserType"},
     *      description="Create UserType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserType")
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
     *                  ref="#/components/schemas/UserType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $userType = $this->userTypeRepository->create($input);

        return $this->sendResponse($userType->toArray(), 'User Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/user-types/{id}",
     *      summary="getUserTypeItem",
     *      tags={"UserType"},
     *      description="Get UserType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserType",
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
     *                  ref="#/components/schemas/UserType"
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
        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        return $this->sendResponse($userType->toArray(), 'User Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/user-types/{id}",
     *      summary="updateUserType",
     *      tags={"UserType"},
     *      description="Update UserType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserType")
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
     *                  ref="#/components/schemas/UserType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        $userType = $this->userTypeRepository->update($input, $id);

        return $this->sendResponse($userType->toArray(), 'UserType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/user-types/{id}",
     *      summary="deleteUserType",
     *      tags={"UserType"},
     *      description="Delete UserType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserType",
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
        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        $userType->delete();

        return $this->sendSuccess('User Type deleted successfully');
    }
}
