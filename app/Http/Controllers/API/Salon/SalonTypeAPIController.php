<?php

namespace App\Http\Controllers\API\Salon;

use App\Http\Requests\API\CreateSalonTypeAPIRequest;
use App\Http\Requests\API\UpdateSalonTypeAPIRequest;
use App\Models\SalonType;
use App\Repositories\SalonTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonTypeController
 */

class SalonTypeAPIController extends AppBaseController
{
    private SalonTypeRepository $salonTypeRepository;

    public function __construct(SalonTypeRepository $salonTypeRepo)
    {
        $this->salonTypeRepository = $salonTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-types",
     *      summary="getSalonTypeList",
     *      tags={"SalonType"},
     *      description="Get all SalonTypes",
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
     *                  @OA\Items(ref="#/components/schemas/SalonType")
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
        $salonTypes = $this->salonTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonTypes->toArray(), 'Salon Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-types",
     *      summary="createSalonType",
     *      tags={"SalonType"},
     *      description="Create SalonType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonType")
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
     *                  ref="#/components/schemas/SalonType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salonType = $this->salonTypeRepository->create($input);

        return $this->sendResponse($salonType->toArray(), 'Salon Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-types/{id}",
     *      summary="getSalonTypeItem",
     *      tags={"SalonType"},
     *      description="Get SalonType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonType",
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
     *                  ref="#/components/schemas/SalonType"
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
        /** @var SalonType $salonType */
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            return $this->sendError('Salon Type not found');
        }

        return $this->sendResponse($salonType->toArray(), 'Salon Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-types/{id}",
     *      summary="updateSalonType",
     *      tags={"SalonType"},
     *      description="Update SalonType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonType")
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
     *                  ref="#/components/schemas/SalonType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonType $salonType */
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            return $this->sendError('Salon Type not found');
        }

        $salonType = $this->salonTypeRepository->update($input, $id);

        return $this->sendResponse($salonType->toArray(), 'SalonType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-types/{id}",
     *      summary="deleteSalonType",
     *      tags={"SalonType"},
     *      description="Delete SalonType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonType",
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
        /** @var SalonType $salonType */
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            return $this->sendError('Salon Type not found');
        }

        $salonType->delete();

        return $this->sendSuccess('Salon Type deleted successfully');
    }
}
