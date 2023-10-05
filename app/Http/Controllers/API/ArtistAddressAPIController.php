<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArtistAddressAPIRequest;
use App\Http\Requests\API\UpdateArtistAddressAPIRequest;
use App\Models\ArtistAddress;
use App\Repositories\ArtistAddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ArtistAddressController
 */

class ArtistAddressAPIController extends AppBaseController
{
    private ArtistAddressRepository $artistAddressRepository;

    public function __construct(ArtistAddressRepository $artistAddressRepo)
    {
        $this->artistAddressRepository = $artistAddressRepo;
    }

    /**
     * @OA\Get(
     *      path="/artist-addresses",
     *      summary="getArtistAddressList",
     *      tags={"ArtistAddress"},
     *      description="Get all ArtistAddresses",
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
     *                  @OA\Items(ref="#/components/schemas/ArtistAddress")
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
        $artistAddresses = $this->artistAddressRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($artistAddresses->toArray(), 'Artist Addresses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/artist-addresses",
     *      summary="createArtistAddress",
     *      tags={"ArtistAddress"},
     *      description="Create ArtistAddress",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistAddress")
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
     *                  ref="#/components/schemas/ArtistAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArtistAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $artistAddress = $this->artistAddressRepository->create($input);

        return $this->sendResponse($artistAddress->toArray(), 'Artist Address saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/artist-addresses/{id}",
     *      summary="getArtistAddressItem",
     *      tags={"ArtistAddress"},
     *      description="Get ArtistAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistAddress",
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
     *                  ref="#/components/schemas/ArtistAddress"
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
        /** @var ArtistAddress $artistAddress */
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            return $this->sendError('Artist Address not found');
        }

        return $this->sendResponse($artistAddress->toArray(), 'Artist Address retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/artist-addresses/{id}",
     *      summary="updateArtistAddress",
     *      tags={"ArtistAddress"},
     *      description="Update ArtistAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistAddress",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ArtistAddress")
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
     *                  ref="#/components/schemas/ArtistAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArtistAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ArtistAddress $artistAddress */
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            return $this->sendError('Artist Address not found');
        }

        $artistAddress = $this->artistAddressRepository->update($input, $id);

        return $this->sendResponse($artistAddress->toArray(), 'ArtistAddress updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/artist-addresses/{id}",
     *      summary="deleteArtistAddress",
     *      tags={"ArtistAddress"},
     *      description="Delete ArtistAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ArtistAddress",
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
        /** @var ArtistAddress $artistAddress */
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            return $this->sendError('Artist Address not found');
        }

        $artistAddress->delete();

        return $this->sendSuccess('Artist Address deleted successfully');
    }
}
