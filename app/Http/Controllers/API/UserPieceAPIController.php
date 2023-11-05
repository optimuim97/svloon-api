<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserPieceAPIRequest;
use App\Http\Requests\API\UpdateUserPieceAPIRequest;
use App\Models\UserPiece;
use App\Repositories\UserPieceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class UserPieceController
 */

class UserPieceAPIController extends AppBaseController
{
    private UserPieceRepository $userPieceRepository;

    public function __construct(UserPieceRepository $userPieceRepo)
    {
        $this->userPieceRepository = $userPieceRepo;
    }

    /**
     * @OA\Get(
     *      path="/user-pieces",
     *      summary="getUserPieceList",
     *      tags={"UserPiece"},
     *      description="Get all UserPieces",
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
     *                  @OA\Items(ref="#/components/schemas/UserPiece")
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
        $userPieces = $this->userPieceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userPieces->toArray(), 'User Pieces retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/user-pieces",
     *      summary="createUserPiece",
     *      tags={"UserPiece"},
     *      description="Create UserPiece",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserPiece")
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
     *                  ref="#/components/schemas/UserPiece"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserPieceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $userPiece = $this->userPieceRepository->create($input);

        return $this->sendResponse($userPiece->toArray(), 'User Piece saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/user-pieces/{id}",
     *      summary="getUserPieceItem",
     *      tags={"UserPiece"},
     *      description="Get UserPiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserPiece",
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
     *                  ref="#/components/schemas/UserPiece"
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
        /** @var UserPiece $userPiece */
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            return $this->sendError('User Piece not found');
        }

        return $this->sendResponse($userPiece->toArray(), 'User Piece retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/user-pieces/{id}",
     *      summary="updateUserPiece",
     *      tags={"UserPiece"},
     *      description="Update UserPiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserPiece",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/UserPiece")
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
     *                  ref="#/components/schemas/UserPiece"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserPieceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var UserPiece $userPiece */
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            return $this->sendError('User Piece not found');
        }

        $userPiece = $this->userPieceRepository->update($input, $id);

        return $this->sendResponse($userPiece->toArray(), 'UserPiece updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/user-pieces/{id}",
     *      summary="deleteUserPiece",
     *      tags={"UserPiece"},
     *      description="Delete UserPiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of UserPiece",
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
        /** @var UserPiece $userPiece */
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            return $this->sendError('User Piece not found');
        }

        $userPiece->delete();

        return $this->sendSuccess('User Piece deleted successfully');
    }
}
