<?php

namespace App\Http\Controllers\API\AnnonceTravelWork;

use App\Http\Requests\API\CreateAnnonceImagesAPIRequest;
use App\Http\Requests\API\UpdateAnnonceImagesAPIRequest;
use App\Models\AnnonceImages;
use App\Repositories\AnnonceImagesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Service\ImgurHelpers;

/**
 * Class AnnonceImagesController
 */

class AnnonceImagesAPIController extends AppBaseController
{
    private AnnonceImagesRepository $annonceImagesRepository;
    use ImgurHelpers;

    public function __construct(AnnonceImagesRepository $annonceImagesRepo)
    {
        $this->annonceImagesRepository = $annonceImagesRepo;
    }

    /**
     * @OA\Get(
     *      path="/annonce-images",
     *      summary="getAnnonceImagesList",
     *      tags={"AnnonceImages"},
     *      description="Get all AnnonceImages",
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
     *                  @OA\Items(ref="#/components/schemas/AnnonceImages")
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
        $annonceImages = $this->annonceImagesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($annonceImages->toArray(), 'Annonce Images retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/annonce-images",
     *      summary="createAnnonceImages",
     *      tags={"AnnonceImages"},
     *      description="Create AnnonceImages",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceImages")
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
     *                  ref="#/components/schemas/AnnonceImages"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnnonceImagesAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['image'] = $this->upload($request, "image");
        $annonceImages = $this->annonceImagesRepository->create($input);

        return $this->sendResponse($annonceImages->toArray(), 'Annonce Images saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/annonce-images/{id}",
     *      summary="getAnnonceImagesItem",
     *      tags={"AnnonceImages"},
     *      description="Get AnnonceImages",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceImages",
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
     *                  ref="#/components/schemas/AnnonceImages"
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
        /** @var AnnonceImages $annonceImages */
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            return $this->sendError('Annonce Images not found');
        }

        return $this->sendResponse($annonceImages->toArray(), 'Annonce Images retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/annonce-images/{id}",
     *      summary="updateAnnonceImages",
     *      tags={"AnnonceImages"},
     *      description="Update AnnonceImages",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceImages",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AnnonceImages")
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
     *                  ref="#/components/schemas/AnnonceImages"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnnonceImagesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AnnonceImages $annonceImages */
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            return $this->sendError('Annonce Images not found');
        }

        $annonceImages = $this->annonceImagesRepository->update($input, $id);

        return $this->sendResponse($annonceImages->toArray(), 'AnnonceImages updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/annonce-images/{id}",
     *      summary="deleteAnnonceImages",
     *      tags={"AnnonceImages"},
     *      description="Delete AnnonceImages",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AnnonceImages",
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
        /** @var AnnonceImages $annonceImages */
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            return $this->sendError('Annonce Images not found');
        }

        $annonceImages->delete();

        return $this->sendSuccess('Annonce Images deleted successfully');
    }
}
