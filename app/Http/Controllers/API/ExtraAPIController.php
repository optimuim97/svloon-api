<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExtraAPIRequest;
use App\Http\Requests\API\UpdateExtraAPIRequest;
use App\Models\Extra;
use App\Repositories\ExtraRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ExtraController
 */

class ExtraAPIController extends AppBaseController
{
    private ExtraRepository $extraRepository;

    public function __construct(ExtraRepository $extraRepo)
    {
        $this->extraRepository = $extraRepo;
    }

    /**
     * @OA\Get(
     *      path="/extras",
     *      summary="getExtraList",
     *      tags={"Extra"},
     *      description="Get all Extras",
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
     *                  @OA\Items(ref="#/components/schemas/Extra")
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
        $extras = $this->extraRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($extras->toArray(), 'Extras retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/extras",
     *      summary="createExtra",
     *      tags={"Extra"},
     *      description="Create Extra",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Extra")
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
     *                  ref="#/components/schemas/Extra"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExtraAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $extra = $this->extraRepository->create($input);

        return $this->sendResponse($extra->toArray(), 'Extra saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/extras/{id}",
     *      summary="getExtraItem",
     *      tags={"Extra"},
     *      description="Get Extra",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Extra",
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
     *                  ref="#/components/schemas/Extra"
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
        /** @var Extra $extra */
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            return $this->sendError('Extra not found');
        }

        return $this->sendResponse($extra->toArray(), 'Extra retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/extras/{id}",
     *      summary="updateExtra",
     *      tags={"Extra"},
     *      description="Update Extra",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Extra",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Extra")
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
     *                  ref="#/components/schemas/Extra"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExtraAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Extra $extra */
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            return $this->sendError('Extra not found');
        }

        $extra = $this->extraRepository->update($input, $id);

        return $this->sendResponse($extra->toArray(), 'Extra updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/extras/{id}",
     *      summary="deleteExtra",
     *      tags={"Extra"},
     *      description="Delete Extra",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Extra",
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
        /** @var Extra $extra */
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            return $this->sendError('Extra not found');
        }

        $extra->delete();

        return $this->sendSuccess('Extra deleted successfully');
    }
}
