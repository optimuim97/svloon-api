<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAppointementAPIRequest;
use App\Http\Requests\API\UpdateAppointementAPIRequest;
use App\Models\Appointement;
use App\Repositories\AppointementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AppointementController
 */

class AppointementAPIController extends AppBaseController
{
    private AppointementRepository $appointementRepository;

    public function __construct(AppointementRepository $appointementRepo)
    {
        $this->appointementRepository = $appointementRepo;
    }

    /**
     * @OA\Get(
     *      path="/appointements",
     *      summary="getAppointementList",
     *      tags={"Appointement"},
     *      description="Get all Appointements",
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
     *                  @OA\Items(ref="#/components/schemas/Appointement")
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
        $appointements = $this->appointementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appointements->toArray(), 'Appointements retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/appointements",
     *      summary="createAppointement",
     *      tags={"Appointement"},
     *      description="Create Appointement",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Appointement")
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
     *                  ref="#/components/schemas/Appointement"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAppointementAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $appointement = $this->appointementRepository->create($input);

        return $this->sendResponse($appointement->toArray(), 'Appointement saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/appointements/{id}",
     *      summary="getAppointementItem",
     *      tags={"Appointement"},
     *      description="Get Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
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
     *                  ref="#/components/schemas/Appointement"
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
        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        return $this->sendResponse($appointement->toArray(), 'Appointement retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/appointements/{id}",
     *      summary="updateAppointement",
     *      tags={"Appointement"},
     *      description="Update Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Appointement")
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
     *                  ref="#/components/schemas/Appointement"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAppointementAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        $appointement = $this->appointementRepository->update($input, $id);

        return $this->sendResponse($appointement->toArray(), 'Appointement updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/appointements/{id}",
     *      summary="deleteAppointement",
     *      tags={"Appointement"},
     *      description="Delete Appointement",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Appointement",
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
        /** @var Appointement $appointement */
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            return $this->sendError('Appointement not found');
        }

        $appointement->delete();

        return $this->sendSuccess('Appointement deleted successfully');
    }
}
