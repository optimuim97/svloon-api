<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryProAPIRequest;
use App\Http\Requests\API\UpdateCategoryProAPIRequest;
use App\Models\CategoryPro;
use App\Repositories\CategoryProRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CategoryProController
 */

class CategoryProAPIController extends AppBaseController
{
    private CategoryProRepository $categoryProRepository;

    public function __construct(CategoryProRepository $categoryProRepo)
    {
        $this->categoryProRepository = $categoryProRepo;
    }

    /**
     * @OA\Get(
     *      path="/category-pros",
     *      summary="getCategoryProList",
     *      tags={"CategoryPro"},
     *      description="Get all CategoryPros",
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
     *                  @OA\Items(ref="#/components/schemas/CategoryPro")
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
        $categoryPros = $this->categoryProRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categoryPros->toArray(), 'Category Pros retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/category-pros",
     *      summary="createCategoryPro",
     *      tags={"CategoryPro"},
     *      description="Create CategoryPro",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CategoryPro")
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
     *                  ref="#/components/schemas/CategoryPro"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoryProAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $categoryPro = $this->categoryProRepository->create($input);

        return $this->sendResponse($categoryPro->toArray(), 'Category Pro saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/category-pros/{id}",
     *      summary="getCategoryProItem",
     *      tags={"CategoryPro"},
     *      description="Get CategoryPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CategoryPro",
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
     *                  ref="#/components/schemas/CategoryPro"
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
        /** @var CategoryPro $categoryPro */
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            return $this->sendError('Category Pro not found');
        }

        return $this->sendResponse($categoryPro->toArray(), 'Category Pro retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/category-pros/{id}",
     *      summary="updateCategoryPro",
     *      tags={"CategoryPro"},
     *      description="Update CategoryPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CategoryPro",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CategoryPro")
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
     *                  ref="#/components/schemas/CategoryPro"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoryProAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CategoryPro $categoryPro */
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            return $this->sendError('Category Pro not found');
        }

        $categoryPro = $this->categoryProRepository->update($input, $id);

        return $this->sendResponse($categoryPro->toArray(), 'CategoryPro updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/category-pros/{id}",
     *      summary="deleteCategoryPro",
     *      tags={"CategoryPro"},
     *      description="Delete CategoryPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CategoryPro",
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
        /** @var CategoryPro $categoryPro */
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            return $this->sendError('Category Pro not found');
        }

        $categoryPro->delete();

        return $this->sendSuccess('Category Pro deleted successfully');
    }
}
