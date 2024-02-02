<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAnnonceCommoditiesAPIRequest;
use App\Http\Requests\API\UpdateAnnonceCommoditiesAPIRequest;
use App\Models\AnnonceCommodities;
use App\Repositories\AnnonceCommoditiesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AnnonceCommoditiesController
 */

class AnnonceCommoditiesAPIController extends AppBaseController
{
    private AnnonceCommoditiesRepository $annonceCommoditiesRepository;

    public function __construct(AnnonceCommoditiesRepository $annonceCommoditiesRepo)
    {
        $this->annonceCommoditiesRepository = $annonceCommoditiesRepo;
    }

    /**
     * @OA\Get(
     *      path="/annonce-commodities",
     *      summary="getAnnonceCommoditiesList",
     *      tags={"AnnonceCommodities"},
     *      description="Get all AnnonceCommodities",
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
     *                  @OA\Items(ref="#/components/schemas/AnnonceCommodities")
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
        $annonceCommodities = $this->annonceCommoditiesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($annonceCommodities->toArray(), 'Annonce Commodities retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/annonce-commodities",
     *      summary="createAnnonceCommodities",
     *      tags={"AnnonceCommodities"},
     *      description="Create AnnonceCommodities",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceCommodities")
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
     *                  ref="#/components/schemas/AnnonceCommodities"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnnonceCommoditiesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $annonceCommodities = $this->annonceCommoditiesRepository->create($input);

        return $this->sendResponse($annonceCommodities->toArray(), 'Annonce Commodities saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/annonce-commodities/{id}",
     *      summary="getAnnonceCommoditiesItem",
     *      tags={"AnnonceCommodities"},
     *      description="Get AnnonceCommodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceCommodities",
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
     *                  ref="#/components/schemas/AnnonceCommodities"
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
        /** @var AnnonceCommodities $annonceCommodities */
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            return $this->sendError('Annonce Commodities not found');
        }

        return $this->sendResponse($annonceCommodities->toArray(), 'Annonce Commodities retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/annonce-commodities/{id}",
     *      summary="updateAnnonceCommodities",
     *      tags={"AnnonceCommodities"},
     *      description="Update AnnonceCommodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceCommodities",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceCommodities")
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
     *                  ref="#/components/schemas/AnnonceCommodities"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnnonceCommoditiesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AnnonceCommodities $annonceCommodities */
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            return $this->sendError('Annonce Commodities not found');
        }

        $annonceCommodities = $this->annonceCommoditiesRepository->update($input, $id);

        return $this->sendResponse($annonceCommodities->toArray(), 'AnnonceCommodities updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/annonce-commodities/{id}",
     *      summary="deleteAnnonceCommodities",
     *      tags={"AnnonceCommodities"},
     *      description="Delete AnnonceCommodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceCommodities",
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
        /** @var AnnonceCommodities $annonceCommodities */
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            return $this->sendError('Annonce Commodities not found');
        }

        $annonceCommodities->delete();

        return $this->sendSuccess('Annonce Commodities deleted successfully');
    }
}
