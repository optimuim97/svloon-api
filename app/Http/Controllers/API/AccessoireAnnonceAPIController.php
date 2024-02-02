<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccessoireAnnonceAPIRequest;
use App\Http\Requests\API\UpdateAccessoireAnnonceAPIRequest;
use App\Models\AccessoireAnnonce;
use App\Repositories\AccessoireAnnonceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AccessoireAnnonceController
 */

class AccessoireAnnonceAPIController extends AppBaseController
{
    private AccessoireAnnonceRepository $accessoireAnnonceRepository;

    public function __construct(AccessoireAnnonceRepository $accessoireAnnonceRepo)
    {
        $this->accessoireAnnonceRepository = $accessoireAnnonceRepo;
    }

    /**
     * @OA\Get(
     *      path="/accessoire-annonces",
     *      summary="getAccessoireAnnonceList",
     *      tags={"AccessoireAnnonce"},
     *      description="Get all AccessoireAnnonces",
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
     *                  @OA\Items(ref="#/components/schemas/AccessoireAnnonce")
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
        $accessoireAnnonces = $this->accessoireAnnonceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($accessoireAnnonces->toArray(), 'Accessoire Annonces retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/accessoire-annonces",
     *      summary="createAccessoireAnnonce",
     *      tags={"AccessoireAnnonce"},
     *      description="Create AccessoireAnnonce",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AccessoireAnnonce")
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
     *                  ref="#/components/schemas/AccessoireAnnonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAccessoireAnnonceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $accessoireAnnonce = $this->accessoireAnnonceRepository->create($input);

        return $this->sendResponse($accessoireAnnonce->toArray(), 'Accessoire Annonce saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/accessoire-annonces/{id}",
     *      summary="getAccessoireAnnonceItem",
     *      tags={"AccessoireAnnonce"},
     *      description="Get AccessoireAnnonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AccessoireAnnonce",
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
     *                  ref="#/components/schemas/AccessoireAnnonce"
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
        /** @var AccessoireAnnonce $accessoireAnnonce */
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            return $this->sendError('Accessoire Annonce not found');
        }

        return $this->sendResponse($accessoireAnnonce->toArray(), 'Accessoire Annonce retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/accessoire-annonces/{id}",
     *      summary="updateAccessoireAnnonce",
     *      tags={"AccessoireAnnonce"},
     *      description="Update AccessoireAnnonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AccessoireAnnonce",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AccessoireAnnonce")
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
     *                  ref="#/components/schemas/AccessoireAnnonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAccessoireAnnonceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AccessoireAnnonce $accessoireAnnonce */
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            return $this->sendError('Accessoire Annonce not found');
        }

        $accessoireAnnonce = $this->accessoireAnnonceRepository->update($input, $id);

        return $this->sendResponse($accessoireAnnonce->toArray(), 'AccessoireAnnonce updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/accessoire-annonces/{id}",
     *      summary="deleteAccessoireAnnonce",
     *      tags={"AccessoireAnnonce"},
     *      description="Delete AccessoireAnnonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AccessoireAnnonce",
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
        /** @var AccessoireAnnonce $accessoireAnnonce */
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            return $this->sendError('Accessoire Annonce not found');
        }

        $accessoireAnnonce->delete();

        return $this->sendSuccess('Accessoire Annonce deleted successfully');
    }
}
