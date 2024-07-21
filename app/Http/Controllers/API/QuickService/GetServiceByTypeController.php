<?php

namespace App\Http\Controllers\API\QuickService;

use App\Http\Controllers\AppBaseController;
use App\Models\Service;
use App\Models\ServiceType;

class GetServiceByTypeController extends AppBaseController
{

    /**
     * @OA\Get (
     *      path="get-service-by-type/{id}",
     *      summary="getserviceByType",
     *      tags={"serviceByType"},
     *      description="get serviceByType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of serviceByType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Service")
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
     *                  ref="#/components/schemas/Service"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function  __invoke($serviceType)
    {
        $serviceType = ServiceType::find($serviceType);

        if (!empty($serviceType)) {
            $services = Service::where('service_type_id', $serviceType->id)->get();

            if (empty($services->toArray())) {
                return $this->sendError("Service not found");
            }

            return $this->sendResponse($services->toArray(), 'Service retrieved successfully');
        }

        return $this->sendError("Service not found");
    }
}
