<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServiceArtistAPIRequest;
use App\Http\Requests\API\UpdateServiceArtistAPIRequest;
use App\Models\ServiceArtist;
use App\Repositories\ServiceArtistRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;

/**
 * Class ServiceArtistController
 */

class ServiceArtistAPIController extends AppBaseController
{
    private ServiceArtistRepository $serviceArtistRepository;

    public function __construct(ServiceArtistRepository $serviceArtistRepo)
    {
        $this->serviceArtistRepository = $serviceArtistRepo;
    }

    /**
     * @OA\Get(
     *      path="/service-artists",
     *      summary="getServiceArtistList",
     *      tags={"ServiceArtist"},
     *      description="Get all ServiceArtists",
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
     *                  @OA\Items(ref="#/components/schemas/ServiceArtist")
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
        $serviceArtists = $this->serviceArtistRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($serviceArtists->toArray(), 'Service Artists retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/service-artists",
     *      summary="createServiceArtist",
     *      tags={"ServiceArtist"},
     *      description="Create ServiceArtist",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceArtist")
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
     *                  ref="#/components/schemas/ServiceArtist"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServiceArtistAPIRequest $request): JsonResponse
    {
        $user = auth("api")->user();
        dd($user);

        if (empty($user)) {
            return $this->sendResponse([], 'L\'utilisateur doit être connecté');
        }

        if ($user->userType?->slug != "artist") {
            return $this->sendResponse([], 'L\'utilisateur doit être de type salon');
        }

        $input = $request->all();

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            "description" => "required",
            "imageUrl" => "required"
        ]);

        $validator->validate();

        if (!empty($input['imageUrl'])) {
            $url = (new ServiceArtist())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }

        $serviceArtist = $this->serviceArtistRepository->create($input);

        return $this->sendResponse($serviceArtist->toArray(), 'Service ajouté');
    }

    /**
     * @OA\Get(
     *      path="/service-artists/{id}",
     *      summary="getServiceArtistItem",
     *      tags={"ServiceArtist"},
     *      description="Get ServiceArtist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceArtist",
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
     *                  ref="#/components/schemas/ServiceArtist"
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
        /** @var ServiceArtist $serviceArtist */
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            return $this->sendError('Service Artist not found');
        }

        return $this->sendResponse($serviceArtist->toArray(), 'Service Artist retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/service-artists/{id}",
     *      summary="updateServiceArtist",
     *      tags={"ServiceArtist"},
     *      description="Update ServiceArtist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceArtist",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ServiceArtist")
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
     *                  ref="#/components/schemas/ServiceArtist"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServiceArtistAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ServiceArtist $serviceArtist */
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            return $this->sendError('Service Artist not found');
        }

        $serviceArtist = $this->serviceArtistRepository->update($input, $id);

        return $this->sendResponse($serviceArtist->toArray(), 'ServiceArtist updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/service-artists/{id}",
     *      summary="deleteServiceArtist",
     *      tags={"ServiceArtist"},
     *      description="Delete ServiceArtist",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ServiceArtist",
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
        /** @var ServiceArtist $serviceArtist */
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            return $this->sendError('Service Artist not found');
        }

        $serviceArtist->delete();

        return $this->sendSuccess('Service Artist deleted successfully');
    }
}
