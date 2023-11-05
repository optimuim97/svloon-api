<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypePieceAPIRequest;
use App\Http\Requests\API\UpdateTypePieceAPIRequest;
use App\Models\TypePiece;
use App\Repositories\TypePieceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TypePieceController
 */

class TypePieceAPIController extends AppBaseController
{
    private TypePieceRepository $typePieceRepository;

    public function __construct(TypePieceRepository $typePieceRepo)
    {
        $this->typePieceRepository = $typePieceRepo;
    }

    /**
     * @OA\Get(
     *      path="/type-pieces",
     *      summary="getTypePieceList",
     *      tags={"TypePiece"},
     *      description="Get all TypePieces",
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
     *                  @OA\Items(ref="#/components/schemas/TypePiece")
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
        $typePieces = $this->typePieceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($typePieces->toArray(), 'Type Pieces retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/type-pieces",
     *      summary="createTypePiece",
     *      tags={"TypePiece"},
     *      description="Create TypePiece",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TypePiece")
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
     *                  ref="#/components/schemas/TypePiece"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypePieceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $typePiece = $this->typePieceRepository->create($input);

        return $this->sendResponse($typePiece->toArray(), 'Type Piece saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/type-pieces/{id}",
     *      summary="getTypePieceItem",
     *      tags={"TypePiece"},
     *      description="Get TypePiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TypePiece",
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
     *                  ref="#/components/schemas/TypePiece"
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
        /** @var TypePiece $typePiece */
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            return $this->sendError('Type Piece not found');
        }

        return $this->sendResponse($typePiece->toArray(), 'Type Piece retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/type-pieces/{id}",
     *      summary="updateTypePiece",
     *      tags={"TypePiece"},
     *      description="Update TypePiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TypePiece",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TypePiece")
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
     *                  ref="#/components/schemas/TypePiece"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypePieceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TypePiece $typePiece */
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            return $this->sendError('Type Piece not found');
        }

        $typePiece = $this->typePieceRepository->update($input, $id);

        return $this->sendResponse($typePiece->toArray(), 'TypePiece updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/type-pieces/{id}",
     *      summary="deleteTypePiece",
     *      tags={"TypePiece"},
     *      description="Delete TypePiece",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TypePiece",
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
        /** @var TypePiece $typePiece */
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            return $this->sendError('Type Piece not found');
        }

        $typePiece->delete();

        return $this->sendSuccess('Type Piece deleted successfully');
    }
}
