<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArtistAPIRequest;
use App\Http\Requests\API\UpdateArtistAPIRequest;
use App\Models\Artist;
use App\Repositories\ArtistRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ArtistController
 */

class ArtistAPIController extends AppBaseController
{
    private ArtistRepository $artistRepository;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepository = $artistRepo;
    }

    /**
     * @OA\Get(
     *      path="/artists",
     *      summary="getArtistList",
     *      tags={"Artist"},
     *      description="Get all Artists",
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
     *                  @OA\Items(ref="#/components/schemas/Artist")
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
        $artists = $this->artistRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($artists->toArray(), 'Artists retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/artists",
     *      summary="createArtist",
     *      tags={"Artist"},
     *      description="Create Artist",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Artist")
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
     *                  ref="#/components/schemas/Artist"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArtistAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $artist = $this->artistRepository->create($input);

        return $this->sendResponse($artist->toArray(), 'Artist saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/artists/{id}",
     *      summary="getArtistItem",
     *      tags={"Artist"},
     *      description="Get Artist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Artist",
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
     *                  ref="#/components/schemas/Artist"
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
        /** @var Artist $artist */
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            return $this->sendError('Artist not found');
        }

        return $this->sendResponse($artist->toArray(), 'Artist retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/artists/{id}",
     *      summary="updateArtist",
     *      tags={"Artist"},
     *      description="Update Artist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Artist",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Artist")
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
     *                  ref="#/components/schemas/Artist"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArtistAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Artist $artist */
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            return $this->sendError('Artist not found');
        }

        $artist = $this->artistRepository->update($input, $id);

        return $this->sendResponse($artist->toArray(), 'Artist updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/artists/{id}",
     *      summary="deleteArtist",
     *      tags={"Artist"},
     *      description="Delete Artist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Artist",
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
        /** @var Artist $artist */
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            return $this->sendError('Artist not found');
        }

        $artist->delete();

        return $this->sendSuccess('Artist deleted successfully');
    }
}
