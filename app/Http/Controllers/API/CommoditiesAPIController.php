<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommoditiesAPIRequest;
use App\Http\Requests\API\UpdateCommoditiesAPIRequest;
use App\Models\Commodities;
use App\Repositories\CommoditiesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CommoditiesController
 */

class CommoditiesAPIController extends AppBaseController
{
    private CommoditiesRepository $commoditiesRepository;

    public function __construct(CommoditiesRepository $commoditiesRepo)
    {
        $this->commoditiesRepository = $commoditiesRepo;
    }

    /**
     * @OA\Get(
     *      path="/commodities",
     *      summary="getCommoditiesList",
     *      tags={"Commodities"},
     *      description="Get all Commodities",
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
     *                  @OA\Items(ref="#/components/schemas/Commodities")
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
        $commodities = $this->commoditiesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($commodities->toArray(), 'Commodities retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/commodities",
     *      summary="createCommodities",
     *      tags={"Commodities"},
     *      description="Create Commodities",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Commodities")
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
     *                  ref="#/components/schemas/Commodities"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCommoditiesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $commodities = $this->commoditiesRepository->create($input);

        return $this->sendResponse($commodities->toArray(), 'Commodities saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/commodities/{id}",
     *      summary="getCommoditiesItem",
     *      tags={"Commodities"},
     *      description="Get Commodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Commodities",
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
     *                  ref="#/components/schemas/Commodities"
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
        /** @var Commodities $commodities */
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            return $this->sendError('Commodities not found');
        }

        return $this->sendResponse($commodities->toArray(), 'Commodities retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/commodities/{id}",
     *      summary="updateCommodities",
     *      tags={"Commodities"},
     *      description="Update Commodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Commodities",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Commodities")
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
     *                  ref="#/components/schemas/Commodities"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCommoditiesAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Commodities $commodities */
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            return $this->sendError('Commodities not found');
        }

        $commodities = $this->commoditiesRepository->update($input, $id);

        return $this->sendResponse($commodities->toArray(), 'Commodities updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/commodities/{id}",
     *      summary="deleteCommodities",
     *      tags={"Commodities"},
     *      description="Delete Commodities",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Commodities",
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
        /** @var Commodities $commodities */
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            return $this->sendError('Commodities not found');
        }

        $commodities->delete();

        return $this->sendSuccess('Commodities deleted successfully');
    }
}