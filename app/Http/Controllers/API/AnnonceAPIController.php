<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAnnonceAPIRequest;
use App\Http\Requests\API\UpdateAnnonceAPIRequest;
use App\Models\Annonce;
use App\Repositories\AnnonceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AnnonceController
 */

class AnnonceAPIController extends AppBaseController
{
    private AnnonceRepository $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepo)
    {
        $this->annonceRepository = $annonceRepo;
    }

    /**
     * @OA\Get(
     *      path="/annonces",
     *      summary="getAnnonceList",
     *      tags={"Annonce"},
     *      description="Get all Annonces",
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
     *                  @OA\Items(ref="#/components/schemas/Annonce")
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
        $annonces = $this->annonceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($annonces->toArray(), 'Annonces retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/annonces",
     *      summary="createAnnonce",
     *      tags={"Annonce"},
     *      description="Create Annonce",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Annonce")
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
     *                  ref="#/components/schemas/Annonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnnonceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $annonce = $this->annonceRepository->create($input);

        return $this->sendResponse($annonce->toArray(), 'Annonce saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/annonces/{id}",
     *      summary="getAnnonceItem",
     *      tags={"Annonce"},
     *      description="Get Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
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
     *                  ref="#/components/schemas/Annonce"
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
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        return $this->sendResponse($annonce->toArray(), 'Annonce retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/annonces/{id}",
     *      summary="updateAnnonce",
     *      tags={"Annonce"},
     *      description="Update Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Annonce")
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
     *                  ref="#/components/schemas/Annonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnnonceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        $annonce = $this->annonceRepository->update($input, $id);

        return $this->sendResponse($annonce->toArray(), 'Annonce updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/annonces/{id}",
     *      summary="deleteAnnonce",
     *      tags={"Annonce"},
     *      description="Delete Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
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
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        $annonce->delete();

        return $this->sendSuccess('Annonce deleted successfully');
    }
}