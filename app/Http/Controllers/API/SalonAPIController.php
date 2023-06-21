<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonAPIRequest;
use App\Http\Requests\API\UpdateSalonAPIRequest;
use App\Models\Salon;
use App\Repositories\SalonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonController
 */

class SalonAPIController extends AppBaseController
{
    private SalonRepository $salonRepository;

    public function __construct(SalonRepository $salonRepo)
    {
        $this->salonRepository = $salonRepo;
    }

    /**
     * @OA\Get(
     *      path="/salons",
     *      summary="getSalonList",
     *      tags={"Salon"},
     *      description="Get all Salons",
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
     *                  @OA\Items(ref="#/components/schemas/Salon")
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
        $salons = $this->salonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salons->toArray(), 'Salons retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salons",
     *      summary="createSalon",
     *      tags={"Salon"},
     *      description="Create Salon",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Salon")
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
     *                  ref="#/components/schemas/Salon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salon = $this->salonRepository->create($input);

        return $this->sendResponse($salon->toArray(), 'Salon saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salons/{id}",
     *      summary="getSalonItem",
     *      tags={"Salon"},
     *      description="Get Salon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Salon",
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
     *                  ref="#/components/schemas/Salon"
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
        /** @var Salon $salon */
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            return $this->sendError('Salon not found');
        }

        return $this->sendResponse($salon->toArray(), 'Salon retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salons/{id}",
     *      summary="updateSalon",
     *      tags={"Salon"},
     *      description="Update Salon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Salon",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Salon")
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
     *                  ref="#/components/schemas/Salon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Salon $salon */
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            return $this->sendError('Salon not found');
        }

        $salon = $this->salonRepository->update($input, $id);

        return $this->sendResponse($salon->toArray(), 'Salon updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salons/{id}",
     *      summary="deleteSalon",
     *      tags={"Salon"},
     *      description="Delete Salon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Salon",
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
        /** @var Salon $salon */
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            return $this->sendError('Salon not found');
        }

        $salon->delete();

        return $this->sendSuccess('Salon deleted successfully');
    }
}
