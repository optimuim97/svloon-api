<?php

namespace App\Http\Controllers\API\AnnonceTravelWork;

use App\Http\Requests\API\CreateAnnonceAPIRequest;
use App\Http\Requests\API\UpdateAnnonceAPIRequest;
use App\Models\Annonce;
use App\Repositories\AnnonceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AnnonceResourceCollection;
use App\Http\Resources\AnnonceRessource;
use App\Service\ImgurHelpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class AnnonceController
 */

class AnnonceAPIController extends AppBaseController
{
    private AnnonceRepository $annonceRepository;

    use ImgurHelpers;

    public function __construct(AnnonceRepository $annonceRepo)
    {
        $this->annonceRepository = $annonceRepo;
    }

    /**
     * @OA\Get(
     *      path="/annonces",
     *      summary="getAnnonceList",
     *      tags={"Annonce"},
     *      description="Get all Annonces",
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
     *                  @OA\Items(ref="#/components/schemas/Annonce")
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
        $annonces = $this->annonceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(new AnnonceResourceCollection($annonces), 'Annonces retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/annonces",
     *      summary="createAnnonce",
     *      tags={"Annonce"},
     *      description="Create Annonce",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Annonce")
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
     *                  ref="#/components/schemas/Annonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $cover_image = $this->upload($request, "cover_image");

        //TODO
        // if(Carbon::parse($input['start_date'])->isPast()){
        //     return $this->sendError('Vous ne pouvez pas choisir une date passé');
        // }

        // if(Carbon::parse($input['end_date'])->isPast()){
        //     return $this->sendError('Vous ne pouvez pas choisir une date passé');
        // }

        // dd($request->validate(Annonce::$rules));

        if($request->file('images')){
            foreach($request->images as $image){

            }
        }

        $input = [
            "reference" => Str::uuid(),
            "label" => $input['label'],
            "address" => $input['address'],
            "rating" => $input['rating'] ?? 0,
            "cover_image" => $cover_image,
            "description" => $input['description'],
            "salon_id" => $input['salon_id'],
            "nombre_places" => $input['nombre_places'],
            "price" => $input['price'],
            "duration" => $input['duration'],
            "start_date" => $input['start_date'],
            "status" => $input['status'] ?? 1,
            "end_date" => $input['end_date']
        ];

        $annonce = $this->annonceRepository->create($input);

        return $this->sendResponse(new AnnonceRessource($annonce), 'Annonce enregistré');
    }

    /**
     * @OA\Get(
     *      path="/annonces/{id}",
     *      summary="getAnnonceItem",
     *      tags={"Annonce"},
     *      description="Get Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
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
     *                  ref="#/components/schemas/Annonce"
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
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        return $this->sendResponse(new AnnonceRessource($annonce), 'Annonce retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/annonces/{id}",
     *      summary="updateAnnonce",
     *      tags={"Annonce"},
     *      description="Update Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Annonce")
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
     *                  ref="#/components/schemas/Annonce"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id,Request $request): JsonResponse
    {
        $input = $request->all();
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        if(isset($input['cover_image'])){
            if ($input['cover_image']) {
                $cover_image = $this->upload($request, "cover_image");
            }
        }

        $input = [
            "label" => !isset($input['label']) ? $annonce->label : $input['label'],
            "address" => !isset($input['address']) ? $annonce->address : $input['address'],
            "rating" => !isset($input['rating']) ? $annonce->rating : $input['rating'] ?? 0,
            "cover_image" => $cover_image ?? $annonce->cover_image,
            "description" => !isset($input['description']) ? $annonce->description : $input['description'],
            "salon_id" => !isset($input['salon_id']) ? $annonce->salon_id : $input['salon_id'],
            "nombre_places" => !isset($input['nombre_places']) ? $annonce->nombre_places : $input['nombre_places'],
            "price" => !isset($input['price']) ? $annonce->price : $input['price'],
            "duration" => !isset($input['duration']) ? $annonce->duration : $input['duration'],
            "start_date" => !isset($input['start_date']) ? $annonce->start_date : $input['start_date'],
            "status" => !isset($input['status']) ? $annonce->status : $input['status'] ?? 1,
            "end_date" => !isset($input['end_date']) ? $annonce->end_date : $input['end_date']
        ];

        $annonce = $this->annonceRepository->update($input, $id);

        return $this->sendResponse(new AnnonceRessource($annonce), 'Annonce updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/annonces/{id}",
     *      summary="deleteAnnonce",
     *      tags={"Annonce"},
     *      description="Delete Annonce",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Annonce",
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
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        $annonce->delete();

        return $this->sendSuccess('Annonce deleted successfully');
    }

    public function updateStatus($id): JsonResponse
    {
        /** @var Annonce $annonce */
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            return $this->sendError('Annonce not found');
        }

        $annonce->status = ! $annonce->status;

        return $this->sendSuccess('Annonce status update successfully');
    }
}
