<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArtistPorfolioAPIRequest;
use App\Http\Requests\API\UpdateArtistPorfolioAPIRequest;
use App\Models\ArtistPorfolio;
use App\Repositories\ArtistPorfolioRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\ArtistPicture;

/**
 * Class ArtistPorfolioController
 */

class ArtistPorfolioAPIController extends AppBaseController
{
    private ArtistPorfolioRepository $artistPorfolioRepository;

    public function __construct(ArtistPorfolioRepository $artistPorfolioRepo)
    {
        $this->artistPorfolioRepository = $artistPorfolioRepo;
    }

    /**
     * @OA\Get(
     *      path="/artist-porfolios",
     *      summary="getArtistPorfolioList",
     *      tags={"ArtistPorfolio"},
     *      description="Get all ArtistPorfolios",
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
     *                  @OA\Items(ref="#/components/schemas/ArtistPorfolio")
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
        $artistPorfolios = $this->artistPorfolioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($artistPorfolios->toArray(), 'Artist Porfolios retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/artist-porfolios",
     *      summary="createArtistPorfolio",
     *      tags={"ArtistPorfolio"},
     *      description="Create ArtistPorfolio",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistPorfolio")
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
     *                  ref="#/components/schemas/ArtistPorfolio"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArtistPorfolioAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        if (empty($input['imageUrl'])) {
            $url = (new ArtistPorfolio())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }

        $artistPorfolio = $this->artistPorfolioRepository->create($input);

        return $this->sendResponse($artistPorfolio->toArray(), 'Artist Porfolio saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/artist-porfolios/{id}",
     *      summary="getArtistPorfolioItem",
     *      tags={"ArtistPorfolio"},
     *      description="Get ArtistPorfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPorfolio",
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
     *                  ref="#/components/schemas/ArtistPorfolio"
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
        /** @var ArtistPorfolio $artistPorfolio */
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            return $this->sendError('Artist Porfolio not found');
        }

        return $this->sendResponse($artistPorfolio->toArray(), 'Artist Porfolio retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/artist-porfolios/{id}",
     *      summary="updateArtistPorfolio",
     *      tags={"ArtistPorfolio"},
     *      description="Update ArtistPorfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPorfolio",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistPorfolio")
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
     *                  ref="#/components/schemas/ArtistPorfolio"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArtistPorfolioAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ArtistPorfolio $artistPorfolio */
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            return $this->sendError('Artist Porfolio not found');
        }

        if (empty($input['imageUrl'])) {
            $url = (new ArtistPorfolio())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }esle{
            $input['imageUrl'] = $artistPorfolio->imageUrl;
        }

        $artistPorfolio = $this->artistPorfolioRepository->update($input, $id);

        return $this->sendResponse($artistPorfolio->toArray(), 'ArtistPorfolio updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/artist-porfolios/{id}",
     *      summary="deleteArtistPorfolio",
     *      tags={"ArtistPorfolio"},
     *      description="Delete ArtistPorfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPorfolio",
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
        /** @var ArtistPorfolio $artistPorfolio */
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            return $this->sendError('Artist Porfolio not found');
        }

        $artistPorfolio->delete();

        return $this->sendSuccess('Artist Porfolio deleted successfully');
    }
}
