<?php

namespace App\Http\Controllers\API\Salon;

use App\Http\Requests\API\CreateCommoditySalonAPIRequest;
use App\Http\Requests\API\UpdateCommoditySalonAPIRequest;
use App\Models\CommoditySalon;
use App\Repositories\CommoditySalonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CommoditySalonController
 */

class CommoditySalonAPIController extends AppBaseController
{
    private CommoditySalonRepository $commoditySalonRepository;

    public function __construct(CommoditySalonRepository $commoditySalonRepo)
    {
        $this->commoditySalonRepository = $commoditySalonRepo;
    }

    /**
     * @OA\Get(
     *      path="/commodity-salons",
     *      summary="getCommoditySalonList",
     *      tags={"CommoditySalon"},
     *      description="Get all CommoditySalons",
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
     *                  @OA\Items(ref="#/components/schemas/CommoditySalon")
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
        $commoditySalons = $this->commoditySalonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($commoditySalons->toArray(), 'Commodity Salons retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/commodity-salons",
     *      summary="createCommoditySalon",
     *      tags={"CommoditySalon"},
     *      description="Create CommoditySalon",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CommoditySalon")
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
     *                  ref="#/components/schemas/CommoditySalon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCommoditySalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $commoditySalon = $this->commoditySalonRepository->create($input);

        return $this->sendResponse($commoditySalon->toArray(), 'Commodity Salon saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/commodity-salons/{id}",
     *      summary="getCommoditySalonItem",
     *      tags={"CommoditySalon"},
     *      description="Get CommoditySalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CommoditySalon",
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
     *                  ref="#/components/schemas/CommoditySalon"
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
        /** @var CommoditySalon $commoditySalon */
        $commoditySalon = $this->commoditySalonRepository->find($id);

        if (empty($commoditySalon)) {
            return $this->sendError('Commodity Salon not found');
        }

        return $this->sendResponse($commoditySalon->toArray(), 'Commodity Salon retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/commodity-salons/{id}",
     *      summary="updateCommoditySalon",
     *      tags={"CommoditySalon"},
     *      description="Update CommoditySalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CommoditySalon",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CommoditySalon")
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
     *                  ref="#/components/schemas/CommoditySalon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCommoditySalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CommoditySalon $commoditySalon */
        $commoditySalon = $this->commoditySalonRepository->find($id);

        if (empty($commoditySalon)) {
            return $this->sendError('Commodity Salon not found');
        }

        $commoditySalon = $this->commoditySalonRepository->update($input, $id);

        return $this->sendResponse($commoditySalon->toArray(), 'CommoditySalon updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/commodity-salons/{id}",
     *      summary="deleteCommoditySalon",
     *      tags={"CommoditySalon"},
     *      description="Delete CommoditySalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CommoditySalon",
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
        /** @var CommoditySalon $commoditySalon */
        $commoditySalon = $this->commoditySalonRepository->find($id);

        if (empty($commoditySalon)) {
            return $this->sendError('Commodity Salon not found');
        }

        $commoditySalon->delete();

        return $this->sendSuccess('Commodity Salon deleted successfully');
    }
}
