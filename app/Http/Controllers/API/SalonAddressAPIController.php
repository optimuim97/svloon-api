<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalonAddressAPIRequest;
use App\Http\Requests\API\UpdateSalonAddressAPIRequest;
use App\Models\SalonAddress;
use App\Repositories\SalonAddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SalonAddressController
 */

class SalonAddressAPIController extends AppBaseController
{
    private SalonAddressRepository $salonAddressRepository;

    public function __construct(SalonAddressRepository $salonAddressRepo)
    {
        $this->salonAddressRepository = $salonAddressRepo;
    }

    /**
     * @OA\Get(
     *      path="/salon-addresses",
     *      summary="getSalonAddressList",
     *      tags={"SalonAddress"},
     *      description="Get all SalonAddresses",
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
     *                  @OA\Items(ref="#/components/schemas/SalonAddress")
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
        $salonAddresses = $this->salonAddressRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salonAddresses->toArray(), 'Salon Addresses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/salon-addresses",
     *      summary="createSalonAddress",
     *      tags={"SalonAddress"},
     *      description="Create SalonAddress",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonAddress")
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
     *                  ref="#/components/schemas/SalonAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSalonAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $salonAddress = $this->salonAddressRepository->create($input);

        return $this->sendResponse($salonAddress->toArray(), 'Salon Address saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/salon-addresses/{id}",
     *      summary="getSalonAddressItem",
     *      tags={"SalonAddress"},
     *      description="Get SalonAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAddress",
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
     *                  ref="#/components/schemas/SalonAddress"
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
        /** @var SalonAddress $salonAddress */
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            return $this->sendError('Salon Address not found');
        }

        return $this->sendResponse($salonAddress->toArray(), 'Salon Address retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/salon-addresses/{id}",
     *      summary="updateSalonAddress",
     *      tags={"SalonAddress"},
     *      description="Update SalonAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAddress",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SalonAddress")
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
     *                  ref="#/components/schemas/SalonAddress"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSalonAddressAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SalonAddress $salonAddress */
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            return $this->sendError('Salon Address not found');
        }

        $salonAddress = $this->salonAddressRepository->update($input, $id);

        return $this->sendResponse($salonAddress->toArray(), 'SalonAddress updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/salon-addresses/{id}",
     *      summary="deleteSalonAddress",
     *      tags={"SalonAddress"},
     *      description="Delete SalonAddress",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of SalonAddress",
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
        /** @var SalonAddress $salonAddress */
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            return $this->sendError('Salon Address not found');
        }

        $salonAddress->delete();

        return $this->sendSuccess('Salon Address deleted successfully');
    }
}
