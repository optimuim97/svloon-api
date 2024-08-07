<?php

namespace App\Http\Controllers\API\AnnonceTravelWork;

use App\Http\Requests\API\CreateAnnonceOrderAPIRequest;
use App\Http\Requests\API\UpdateAnnonceOrderAPIRequest;
use App\Models\AnnonceOrder;
use App\Repositories\AnnonceOrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AnnonceOrderCollection;
use App\Http\Resources\AnnonceOrderResource;
use App\Http\Resources\AnnonceRessource;
use App\Models\OrderStatus;

/**
 * Class AnnonceOrderController
 */

class AnnonceOrderAPIController extends AppBaseController
{
    private AnnonceOrderRepository $annonceOrderRepository;

    public function __construct(AnnonceOrderRepository $annonceOrderRepo)
    {
        $this->annonceOrderRepository = $annonceOrderRepo;
    }

    /**
     * @OA\Get(
     *      path="/annonce-orders",
     *      summary="getAnnonceOrderList",
     *      tags={"AnnonceOrder"},
     *      description="Get all AnnonceOrders",
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
     *                  @OA\Items(ref="#/components/schemas/AnnonceOrder")
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
        $annonceOrders = $this->annonceOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($annonceOrders->toArray(), 'Annonce Orders retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/annonce-orders",
     *      summary="createAnnonceOrder",
     *      tags={"AnnonceOrder"},
     *      description="Create AnnonceOrder",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceOrder")
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
     *                  ref="#/components/schemas/AnnonceOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnnonceOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $user = auth("api")->user();
        if ($user == null) {
            return $this->sendError("Votre session a expire", 401);
        }

        $input = $request->all();
        $input["user_id"] = $user->id;
        $annonceOrder = $this->annonceOrderRepository->create($input);

        return $this->sendResponse(new AnnonceOrderResource($annonceOrder), 'Annonce Order saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/annonce-orders/{id}",
     *      summary="getAnnonceOrderItem",
     *      tags={"AnnonceOrder"},
     *      description="Get AnnonceOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceOrder",
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
     *                  ref="#/components/schemas/AnnonceOrder"
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
        /** @var AnnonceOrder $annonceOrder */
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            return $this->sendError('Annonce Order not found');
        }
        return $this->sendResponse($annonceOrder->toArray(), 'Annonce Order retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/annonce-orders/{id}",
     *      summary="updateAnnonceOrder",
     *      tags={"AnnonceOrder"},
     *      description="Update AnnonceOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceOrder",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceOrder")
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
     *                  ref="#/components/schemas/AnnonceOrder"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnnonceOrderAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AnnonceOrder $annonceOrder */
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            return $this->sendError('Annonce Order not found');
        }

        $annonceOrder = $this->annonceOrderRepository->update($input, $id);

        return $this->sendResponse($annonceOrder->toArray(), 'AnnonceOrder updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/annonce-orders/{id}",
     *      summary="deleteAnnonceOrder",
     *      tags={"AnnonceOrder"},
     *      description="Delete AnnonceOrder",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceOrder",
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
        /** @var AnnonceOrder $annonceOrder */
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            return $this->sendError('Annonce Order not found');
        }

        $annonceOrder->delete();

        return $this->sendSuccess('Annonce Order deleted successfully');
    }

    public function changeStatus($id, Request $request)
    {
        /** @var AnnonceOrder $annonceOrder */
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            return $this->sendError('Annonce Order not found');
        }

        if (empty(OrderStatus::find($request->order_status_id))) {
            return $this->sendError('Statut non valide', 400);
        }

        $annonceOrder->order_status_id = $request->order_status_id;
        $annonceOrder->save();

        return $this->sendResponse(new AnnonceRessource($annonceOrder), 'Annonce Order Updated successfully');
    }

    public function getUserAnnonceOrder()
    {
        $user = auth("api")->user();
        if ($user == null) {
            return $this->sendError("Votre session a expire", 401);
        }
        $annonceOrder =  AnnonceOrder::where(['user_id'=> $user->id])->get();
        return $this->sendResponse(new AnnonceOrderCollection($annonceOrder), 'Liste des commandes d\'annonce de l\'utilisateur ');
    }
}
