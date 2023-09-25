<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArtistPictureAPIRequest;
use App\Http\Requests\API\UpdateArtistPictureAPIRequest;
use App\Models\ArtistPicture;
use App\Repositories\ArtistPictureRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ArtistPictureController
 */

class ArtistPictureAPIController extends AppBaseController
{
    private ArtistPictureRepository $artistPictureRepository;

    public function __construct(ArtistPictureRepository $artistPictureRepo)
    {
        $this->artistPictureRepository = $artistPictureRepo;
    }

    /**
     * @OA\Get(
     *      path="/artist-pictures",
     *      summary="getArtistPictureList",
     *      tags={"ArtistPicture"},
     *      description="Get all ArtistPictures",
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
     *                  @OA\Items(ref="#/components/schemas/ArtistPicture")
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
        $artistPictures = $this->artistPictureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($artistPictures->toArray(), 'Artist Pictures retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/artist-pictures",
     *      summary="createArtistPicture",
     *      tags={"ArtistPicture"},
     *      description="Create ArtistPicture",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistPicture")
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
     *                  ref="#/components/schemas/ArtistPicture"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArtistPictureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        if (empty($input['imageUrl'])) {
            $url = (new ArtistPicture())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }

        $artistPicture = $this->artistPictureRepository->create($input);

        return $this->sendResponse($artistPicture->toArray(), 'Artist Picture saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/artist-pictures/{id}",
     *      summary="getArtistPictureItem",
     *      tags={"ArtistPicture"},
     *      description="Get ArtistPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPicture",
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
     *                  ref="#/components/schemas/ArtistPicture"
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
        /** @var ArtistPicture $artistPicture */
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            return $this->sendError('Artist Picture not found');
        }

        return $this->sendResponse($artistPicture->toArray(), 'Artist Picture retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/artist-pictures/{id}",
     *      summary="updateArtistPicture",
     *      tags={"ArtistPicture"},
     *      description="Update ArtistPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPicture",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistPicture")
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
     *                  ref="#/components/schemas/ArtistPicture"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArtistPictureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ArtistPicture $artistPicture */
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            return $this->sendError('Artist Picture not found');
        }

        if (empty($input['imageUrl'])) {
            $url = (new ArtistPicture())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        } else {
            $input['imageUrl'] = $artistPicture->imageUrl;
        }

        $artistPicture = $this->artistPictureRepository->update($input, $id);

        return $this->sendResponse($artistPicture->toArray(), 'ArtistPicture updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/artist-pictures/{id}",
     *      summary="deleteArtistPicture",
     *      tags={"ArtistPicture"},
     *      description="Delete ArtistPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistPicture",
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
        /** @var ArtistPicture $artistPicture */
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            return $this->sendError('Artist Picture not found');
        }

        $artistPicture->delete();

        return $this->sendSuccess('Artist Picture deleted successfully');
    }
}
