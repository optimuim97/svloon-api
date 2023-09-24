<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonPictureAPIRequest;
use App\Http\Requests\API\UpdateSalonPictureAPIRequest;
use App\Models\SalonPicture;
use App\Repositories\SalonPictureRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonPictureController
 */

class SalonPictureAPIController extends AppBaseController
{
    private SalonPictureRepository $salonPictureRepository;

    public function __construct(SalonPictureRepository $salonPictureRepo)
    {
        $this->salonPictureRepository = $salonPictureRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-pictures",
     *      summary="getSalonPictureList",
     *      tags={"SalonPicture"},
     *      description="Get all SalonPictures",
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
     *                  @OA\Items(ref="#/components/schemas/SalonPicture")
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
        $salonPictures = $this->salonPictureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonPictures->toArray(), 'Salon Pictures retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-pictures",
     *      summary="createSalonPicture",
     *      tags={"SalonPicture"},
     *      description="Create SalonPicture",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonPicture")
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
     *                  ref="#/components/schemas/SalonPicture"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonPictureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $url = (new SalonPicture())->upload($request, 'path');
        $input['path'] = $url;

        $salonPicture = $this->salonPictureRepository->create($input);

        return $this->sendResponse($salonPicture->toArray(), 'Salon Picture saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-pictures/{id}",
     *      summary="getSalonPictureItem",
     *      tags={"SalonPicture"},
     *      description="Get SalonPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonPicture",
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
     *                  ref="#/components/schemas/SalonPicture"
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
        /** @var SalonPicture $salonPicture */
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            return $this->sendError('Salon Picture not found');
        }

        return $this->sendResponse($salonPicture->toArray(), 'Salon Picture retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-pictures/{id}",
     *      summary="updateSalonPicture",
     *      tags={"SalonPicture"},
     *      description="Update SalonPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonPicture",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonPicture")
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
     *                  ref="#/components/schemas/SalonPicture"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonPictureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonPicture $salonPicture */
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            return $this->sendError('Salon Picture not found');
        }

        $salonPicture = $this->salonPictureRepository->update($input, $id);

        return $this->sendResponse($salonPicture->toArray(), 'SalonPicture updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-pictures/{id}",
     *      summary="deleteSalonPicture",
     *      tags={"SalonPicture"},
     *      description="Delete SalonPicture",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonPicture",
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
        /** @var SalonPicture $salonPicture */
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            return $this->sendError('Salon Picture not found');
        }

        $salonPicture->delete();

        return $this->sendSuccess('Salon Picture deleted successfully');
    }
}
