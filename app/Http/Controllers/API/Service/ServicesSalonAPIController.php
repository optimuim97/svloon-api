<?php

namespace App\Http\Controllers\API\Service;

use App\Http\Requests\API\CreateServicesSalonAPIRequest;
use App\Http\Requests\API\UpdateServicesSalonAPIRequest;
use App\Models\ServicesSalon;
use App\Repositories\ServicesSalonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ServicesSalonController
 */

class ServicesSalonAPIController extends AppBaseController
{
    private ServicesSalonRepository $servicesSalonRepository;

    public function __construct(ServicesSalonRepository $servicesSalonRepo)
    {
        $this->servicesSalonRepository = $servicesSalonRepo;
    }

    /**
     * @OA\Get(
     *      path="/services-salons",
     *      summary="getServicesSalonList",
     *      tags={"ServicesSalon"},
     *      description="Get all ServicesSalons",
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
     *                  @OA\Items(ref="#/components/schemas/ServicesSalon")
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
        $servicesSalons = $this->servicesSalonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($servicesSalons->toArray(), 'Services Salons retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/services-salons",
     *      summary="Add service for salon",
     *      tags={"ServicesSalon"},
     *      description="Create ServicesSalon",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServicesSalon")
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
     *                  ref="#/components/schemas/ServicesSalon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServicesSalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $servicesSalon = $this->servicesSalonRepository->create($input);

        return $this->sendResponse($servicesSalon->toArray(), 'Services Salon saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/services-salons/{id}",
     *      summary="getServicesSalonItem",
     *      tags={"ServicesSalon"},
     *      description="Get ServicesSalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicesSalon",
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
     *                  ref="#/components/schemas/ServicesSalon"
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
        /** @var ServicesSalon $servicesSalon */
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            return $this->sendError('Services Salon not found');
        }

        return $this->sendResponse($servicesSalon->toArray(), 'Services Salon retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/services-salons/{id}",
     *      summary="updateServicesSalon",
     *      tags={"ServicesSalon"},
     *      description="Update ServicesSalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicesSalon",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServicesSalon")
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
     *                  ref="#/components/schemas/ServicesSalon"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServicesSalonAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ServicesSalon $servicesSalon */
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            return $this->sendError('Services Salon not found');
        }

        $servicesSalon = $this->servicesSalonRepository->update($input, $id);

        return $this->sendResponse($servicesSalon->toArray(), 'ServicesSalon updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/services-salons/{id}",
     *      summary="delete Services for Salon",
     *      tags={"ServicesSalon"},
     *      description="Delete ServicesSalon",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServicesSalon",
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
        /** @var ServicesSalon $servicesSalon */
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            return $this->sendError('Services Salon not found');
        }

        $servicesSalon->delete();

        return $this->sendSuccess('Services Salon deleted successfully');
    }
}
