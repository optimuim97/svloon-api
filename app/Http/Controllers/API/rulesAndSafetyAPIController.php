<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterulesAndSafetyAPIRequest;
use App\Http\Requests\API\UpdaterulesAndSafetyAPIRequest;
use App\Models\rulesAndSafety;
use App\Repositories\rulesAndSafetyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class rulesAndSafetyController
 */

class rulesAndSafetyAPIController extends AppBaseController
{
    private rulesAndSafetyRepository $rulesAndSafetyRepository;

    public function __construct(rulesAndSafetyRepository $rulesAndSafetyRepo)
    {
        $this->rulesAndSafetyRepository = $rulesAndSafetyRepo;
    }

    /**
     * @OA\Get(
     *      path="/rules-and-safeties",
     *      summary="getrulesAndSafetyList",
     *      tags={"rulesAndSafety"},
     *      description="Get all rulesAndSafeties",
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
     *                  @OA\Items(ref="#/components/schemas/rulesAndSafety")
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
        $rulesAndSafeties = $this->rulesAndSafetyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rulesAndSafeties->toArray(), 'Rules And Safeties retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/rules-and-safeties",
     *      summary="createrulesAndSafety",
     *      tags={"rulesAndSafety"},
     *      description="Create rulesAndSafety",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/rulesAndSafety")
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
     *                  ref="#/components/schemas/rulesAndSafety"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreaterulesAndSafetyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $rulesAndSafety = $this->rulesAndSafetyRepository->create($input);

        return $this->sendResponse($rulesAndSafety->toArray(), 'Rules And Safety saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/rules-and-safeties/{id}",
     *      summary="getrulesAndSafetyItem",
     *      tags={"rulesAndSafety"},
     *      description="Get rulesAndSafety",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of rulesAndSafety",
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
     *                  ref="#/components/schemas/rulesAndSafety"
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
        /** @var rulesAndSafety $rulesAndSafety */
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            return $this->sendError('Rules And Safety not found');
        }

        return $this->sendResponse($rulesAndSafety->toArray(), 'Rules And Safety retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/rules-and-safeties/{id}",
     *      summary="updaterulesAndSafety",
     *      tags={"rulesAndSafety"},
     *      description="Update rulesAndSafety",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of rulesAndSafety",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/rulesAndSafety")
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
     *                  ref="#/components/schemas/rulesAndSafety"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdaterulesAndSafetyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var rulesAndSafety $rulesAndSafety */
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            return $this->sendError('Rules And Safety not found');
        }

        $rulesAndSafety = $this->rulesAndSafetyRepository->update($input, $id);

        return $this->sendResponse($rulesAndSafety->toArray(), 'rulesAndSafety updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/rules-and-safeties/{id}",
     *      summary="deleterulesAndSafety",
     *      tags={"rulesAndSafety"},
     *      description="Delete rulesAndSafety",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of rulesAndSafety",
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
        /** @var rulesAndSafety $rulesAndSafety */
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            return $this->sendError('Rules And Safety not found');
        }

        $rulesAndSafety->delete();

        return $this->sendSuccess('Rules And Safety deleted successfully');
    }
}
