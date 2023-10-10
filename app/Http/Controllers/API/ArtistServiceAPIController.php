<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArtistServiceAPIRequest;
use App\Http\Requests\API\UpdateArtistServiceAPIRequest;
use App\Models\ArtistService;
use App\Repositories\ArtistServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ArtistServiceController
 */

class ArtistServiceAPIController extends AppBaseController
{
    private ArtistServiceRepository $artistServiceRepository;

    public function __construct(ArtistServiceRepository $artistServiceRepo)
    {
        $this->artistServiceRepository = $artistServiceRepo;
    }

    /**
     * @OA\Get(
     *      path="/artist-services",
     *      summary="getArtistServiceList",
     *      tags={"ArtistService"},
     *      description="Get all ArtistServices",
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
     *                  @OA\Items(ref="#/components/schemas/ArtistService")
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
        $artistServices = $this->artistServiceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($artistServices->toArray(), 'Artist Services retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/artist-services",
     *      summary="createArtistService",
     *      tags={"ArtistService"},
     *      description="Create ArtistService",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistService")
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
     *                  ref="#/components/schemas/ArtistService"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArtistServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $artistService = $this->artistServiceRepository->create($input);

        return $this->sendResponse($artistService->toArray(), 'Artist Service saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/artist-services/{id}",
     *      summary="getArtistServiceItem",
     *      tags={"ArtistService"},
     *      description="Get ArtistService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistService",
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
     *                  ref="#/components/schemas/ArtistService"
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
        /** @var ArtistService $artistService */
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            return $this->sendError('Artist Service not found');
        }

        return $this->sendResponse($artistService->toArray(), 'Artist Service retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/artist-services/{id}",
     *      summary="updateArtistService",
     *      tags={"ArtistService"},
     *      description="Update ArtistService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistService",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistService")
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
     *                  ref="#/components/schemas/ArtistService"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArtistServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ArtistService $artistService */
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            return $this->sendError('Artist Service not found');
        }

        $artistService = $this->artistServiceRepository->update($input, $id);

        return $this->sendResponse($artistService->toArray(), 'ArtistService updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/artist-services/{id}",
     *      summary="deleteArtistService",
     *      tags={"ArtistService"},
     *      description="Delete ArtistService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistService",
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
        /** @var ArtistService $artistService */
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            return $this->sendError('Artist Service not found');
        }

        $artistService->delete();

        return $this->sendSuccess('Artist Service deleted successfully');
    }
}
