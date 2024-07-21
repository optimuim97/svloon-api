<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCertificationProAPIRequest;
use App\Http\Requests\API\UpdateCertificationProAPIRequest;
use App\Models\CertificationPro;
use App\Repositories\CertificationProRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CertificationProController
 */

class CertificationProAPIController extends AppBaseController
{
    private CertificationProRepository $certificationProRepository;

    public function __construct(CertificationProRepository $certificationProRepo)
    {
        $this->certificationProRepository = $certificationProRepo;
    }

    /**
     * @OA\Get(
     *      path="/certification-pros",
     *      summary="getCertificationProList",
     *      tags={"CertificationPro"},
     *      description="Get all CertificationPros",
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
     *                  @OA\Items(ref="#/components/schemas/CertificationPro")
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
        $certificationPros = $this->certificationProRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($certification-pros->toArray(), 'Certification Pros retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/certification-pros",
     *      summary="createCertificationPro",
     *      tags={"CertificationPro"},
     *      description="Create CertificationPro",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CertificationPro")
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
     *                  ref="#/components/schemas/CertificationPro"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCertificationProAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $certificationPro = $this->certificationProRepository->create($input);

        return $this->sendResponse($certificationPro->toArray(), 'Certification Pro saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/certification-pros/{id}",
     *      summary="getCertificationProItem",
     *      tags={"CertificationPro"},
     *      description="Get CertificationPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CertificationPro",
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
     *                  ref="#/components/schemas/CertificationPro"
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
        /** @var CertificationPro $certificationPro */
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            return $this->sendError('Certification Pro not found');
        }

        return $this->sendResponse($certificationPro->toArray(), 'Certification Pro retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/certification-pros/{id}",
     *      summary="updateCertificationPro",
     *      tags={"CertificationPro"},
     *      description="Update CertificationPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CertificationPro",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/CertificationPro")
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
     *                  ref="#/components/schemas/CertificationPro"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCertificationProAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CertificationPro $certificationPro */
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            return $this->sendError('Certification Pro not found');
        }

        $certificationPro = $this->certificationProRepository->update($input, $id);

        return $this->sendResponse($certificationPro->toArray(), 'CertificationPro updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/certification-pros/{id}",
     *      summary="deleteCertificationPro",
     *      tags={"CertificationPro"},
     *      description="Delete CertificationPro",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of CertificationPro",
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
        /** @var CertificationPro $certificationPro */
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            return $this->sendError('Certification Pro not found');
        }

        $certificationPro->delete();

        return $this->sendSuccess('Certification Pro deleted successfully');
    }
}
