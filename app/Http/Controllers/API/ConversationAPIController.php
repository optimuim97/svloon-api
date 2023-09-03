<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConversationAPIRequest;
use App\Http\Requests\API\UpdateConversationAPIRequest;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ConversationController
 */

class ConversationAPIController extends AppBaseController
{
    private ConversationRepository $conversationRepository;

    public function __construct(ConversationRepository $conversationRepo)
    {
        $this->conversationRepository = $conversationRepo;
    }

    /**
     * @OA\Get(
     *      path="/conversations",
     *      summary="getConversationList",
     *      tags={"Conversation"},
     *      description="Get all Conversations",
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
     *                  @OA\Items(ref="#/components/schemas/Conversation")
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
        $conversations = $this->conversationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($conversations->toArray(), 'Conversations retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/conversations",
     *      summary="createConversation",
     *      tags={"Conversation"},
     *      description="Create Conversation",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Conversation")
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
     *                  ref="#/components/schemas/Conversation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConversationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $conversation = $this->conversationRepository->create($input);

        return $this->sendResponse($conversation->toArray(), 'Conversation saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/conversations/{id}",
     *      summary="getConversationItem",
     *      tags={"Conversation"},
     *      description="Get Conversation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Conversation",
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
     *                  ref="#/components/schemas/Conversation"
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
        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        return $this->sendResponse($conversation->toArray(), 'Conversation retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/conversations/{id}",
     *      summary="updateConversation",
     *      tags={"Conversation"},
     *      description="Update Conversation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Conversation",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Conversation")
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
     *                  ref="#/components/schemas/Conversation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConversationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        $conversation = $this->conversationRepository->update($input, $id);

        return $this->sendResponse($conversation->toArray(), 'Conversation updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/conversations/{id}",
     *      summary="deleteConversation",
     *      tags={"Conversation"},
     *      description="Delete Conversation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Conversation",
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
        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        $conversation->delete();

        return $this->sendSuccess('Conversation deleted successfully');
    }
}
