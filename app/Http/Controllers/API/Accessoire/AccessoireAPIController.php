<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccessoireAPIRequest;
use App\Http\Requests\API\UpdateAccessoireAPIRequest;
use App\Models\Accessoire;
use App\Repositories\AccessoireRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Service\ImgurHelpers;

/**
 * Class AccessoireController
 */

class AccessoireAPIController extends AppBaseController
{
    private AccessoireRepository $accessoireRepository;
    use ImgurHelpers;

    public function __construct(AccessoireRepository $accessoireRepo)
    {
        $this->accessoireRepository = $accessoireRepo;
    }

    /**
     * @OA\Get(
     *      path="/accessoires",
     *      summary="getAccessoireList",
     *      tags={"Accessoire"},
     *      description="Get all Accessoires",
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
     *                  @OA\Items(ref="#/components/schemas/Accessoire")
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
        $accessoires = $this->accessoireRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($accessoires->toArray(), 'Accessoires retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/accessoires",
     *      summary="createAccessoire",
     *      tags={"Accessoire"},
     *      description="Create Accessoire",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Accessoire")
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
     *                  ref="#/components/schemas/Accessoire"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAccessoireAPIRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['icone'] = $this->upload($request, 'icone');

        $accessoire = $this->accessoireRepository->create($input);

        return $this->sendResponse($accessoire->toArray(), 'Accessoire saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/accessoires/{id}",
     *      summary="getAccessoireItem",
     *      tags={"Accessoire"},
     *      description="Get Accessoire",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Accessoire",
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
     *                  ref="#/components/schemas/Accessoire"
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
        /** @var Accessoire $accessoire */
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            return $this->sendError('Accessoire not found');
        }

        return $this->sendResponse($accessoire->toArray(), 'Accessoire retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/accessoires/{id}",
     *      summary="updateAccessoire",
     *      tags={"Accessoire"},
     *      description="Update Accessoire",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Accessoire",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Accessoire")
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
     *                  ref="#/components/schemas/Accessoire"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAccessoireAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Accessoire $accessoire */
        $accessoire = $this->accessoireRepository->find($id);

        if(!empty($input['icone'] ?? null)){
            $input['icone'] = $this->upload($request, 'icone');
        }

        if (empty($accessoire)) {
            return $this->sendError('Accessoire not found');
        }

        $accessoire = $this->accessoireRepository->update($input, $id);

        return $this->sendResponse($accessoire->toArray(), 'Accessoire updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/accessoires/{id}",
     *      summary="deleteAccessoire",
     *      tags={"Accessoire"},
     *      description="Delete Accessoire",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Accessoire",
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
        /** @var Accessoire $accessoire */
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            return $this->sendError('Accessoire not found');
        }

        $accessoire->delete();

        return $this->sendSuccess('Accessoire deleted successfully');
    }
}
