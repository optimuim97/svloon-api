<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCarteAPIRequest;
use App\Http\Requests\API\UpdateCarteAPIRequest;
use App\Models\Carte;
use App\Repositories\CarteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CarteController
 */

class CarteAPIController extends AppBaseController
{
    private CarteRepository $carteRepository;

    public function __construct(CarteRepository $carteRepo)
    {
        $this->carteRepository = $carteRepo;
    }

    /**
     * @OA\Get(
     *      path="/cartes",
     *      summary="getCarteList",
     *      tags={"Carte"},
     *      description="Get all Cartes",
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
     *                  @OA\Items(ref="#/components/schemas/Carte")
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
        $cartes = $this->carteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cartes->toArray(), 'Cartes retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/cartes",
     *      summary="createCarte",
     *      tags={"Carte"},
     *      description="Create Carte",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Carte")
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
     *                  ref="#/components/schemas/Carte"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCarteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $carte = $this->carteRepository->create($input);

        return $this->sendResponse($carte->toArray(), 'Carte saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/cartes/{id}",
     *      summary="getCarteItem",
     *      tags={"Carte"},
     *      description="Get Carte",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carte",
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
     *                  ref="#/components/schemas/Carte"
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
        /** @var Carte $carte */
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            return $this->sendError('Carte not found');
        }

        return $this->sendResponse($carte->toArray(), 'Carte retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/cartes/{id}",
     *      summary="updateCarte",
     *      tags={"Carte"},
     *      description="Update Carte",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carte",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Carte")
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
     *                  ref="#/components/schemas/Carte"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCarteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Carte $carte */
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            return $this->sendError('Carte not found');
        }

        $carte = $this->carteRepository->update($input, $id);

        return $this->sendResponse($carte->toArray(), 'Carte updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/cartes/{id}",
     *      summary="deleteCarte",
     *      tags={"Carte"},
     *      description="Delete Carte",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carte",
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
        /** @var Carte $carte */
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            return $this->sendError('Carte not found');
        }

        $carte->delete();

        return $this->sendSuccess('Carte deleted successfully');
    }
}
