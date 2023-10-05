<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonServiceAPIRequest;
use App\Http\Requests\API\UpdateSalonServiceAPIRequest;
use App\Models\SalonService;
use App\Repositories\SalonServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonServiceController
 */

class SalonServiceAPIController extends AppBaseController
{
    private SalonServiceRepository $salonServiceRepository;

    public function __construct(SalonServiceRepository $salonServiceRepo)
    {
        $this->salonServiceRepository = $salonServiceRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-services",
     *      summary="getSalonServiceList",
     *      tags={"SalonService"},
     *      description="Get all SalonServices",
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
     *                  @OA\Items(ref="#/components/schemas/SalonService")
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
        $salonServices = $this->salonServiceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonServices->toArray(), 'Salon Services retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-services",
     *      summary="createSalonService",
     *      tags={"SalonService"},
     *      description="Create SalonService",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonService")
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
     *                  ref="#/components/schemas/SalonService"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        if (!empty($input['imageUrl'])) {
            $url = (new SalonService())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }

        $salonService = $this->salonServiceRepository->create($input);

        return $this->sendResponse($salonService->toArray(), 'Salon Service saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-services/{id}",
     *      summary="getSalonServiceItem",
     *      tags={"SalonService"},
     *      description="Get SalonService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonService",
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
     *                  ref="#/components/schemas/SalonService"
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
        /** @var SalonService $salonService */
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            return $this->sendError('Salon Service not found');
        }

        return $this->sendResponse($salonService->toArray(), 'Salon Service retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-services/{id}",
     *      summary="updateSalonService",
     *      tags={"SalonService"},
     *      description="Update SalonService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonService",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonService")
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
     *                  ref="#/components/schemas/SalonService"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonService $salonService */
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            return $this->sendError('Salon Service not found');
        }

        $input = $request->all();

        if (!empty($input['imageUrl'])) {
            $url = (new SalonService())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        } else {
            $input['imageUrl'] = $salonService->imageUrl;
        }

        $salonService = $this->salonServiceRepository->update($input, $id);

        return $this->sendResponse($salonService->toArray(), 'SalonService updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-services/{id}",
     *      summary="deleteSalonService",
     *      tags={"SalonService"},
     *      description="Delete SalonService",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonService",
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
        /** @var SalonService $salonService */
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            return $this->sendError('Salon Service not found');
        }

        $salonService->delete();

        return $this->sendSuccess('Salon Service deleted successfully');
    }
}
