<?php

namespace App\Http\Controllers\API\Artist;

use App\Http\Requests\API\CreatePortfolioAPIRequest;
use App\Http\Requests\API\UpdatePortfolioAPIRequest;
use App\Models\Portfolio;
use App\Repositories\PortfolioRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PortfolioController
 */

class PortfolioAPIController extends AppBaseController
{
    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepo)
    {
        $this->portfolioRepository = $portfolioRepo;
    }

    /**
     * @OA\Get(
     *      path="/portfolios",
     *      summary="getPortfolioList",
     *      tags={"Portfolio"},
     *      description="Get all Portfolios",
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
     *                  @OA\Items(ref="#/components/schemas/Portfolio")
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
        $portfolios = $this->portfolioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($portfolios->toArray(), 'Portfolios retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/portfolios",
     *      summary="createPortfolio",
     *      tags={"Portfolio"},
     *      description="Create Portfolio",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Portfolio")
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
     *                  ref="#/components/schemas/Portfolio"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePortfolioAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $portfolio = $this->portfolioRepository->create($input);

        return $this->sendResponse($portfolio->toArray(), 'Portfolio saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/portfolios/{id}",
     *      summary="getPortfolioItem",
     *      tags={"Portfolio"},
     *      description="Get Portfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Portfolio",
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
     *                  ref="#/components/schemas/Portfolio"
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
        /** @var Portfolio $portfolio */
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            return $this->sendError('Portfolio not found');
        }

        return $this->sendResponse($portfolio->toArray(), 'Portfolio retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/portfolios/{id}",
     *      summary="updatePortfolio",
     *      tags={"Portfolio"},
     *      description="Update Portfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Portfolio",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Portfolio")
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
     *                  ref="#/components/schemas/Portfolio"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePortfolioAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Portfolio $portfolio */
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            return $this->sendError('Portfolio not found');
        }

        $portfolio = $this->portfolioRepository->update($input, $id);

        return $this->sendResponse($portfolio->toArray(), 'Portfolio updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/portfolios/{id}",
     *      summary="deletePortfolio",
     *      tags={"Portfolio"},
     *      description="Delete Portfolio",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Portfolio",
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
        /** @var Portfolio $portfolio */
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            return $this->sendError('Portfolio not found');
        }

        $portfolio->delete();

        return $this->sendSuccess('Portfolio deleted successfully');
    }
}
