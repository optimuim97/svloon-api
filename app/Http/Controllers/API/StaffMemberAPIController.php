<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStaffMemberAPIRequest;
use App\Http\Requests\API\UpdateStaffMemberAPIRequest;
use App\Models\StaffMember;
use App\Repositories\StaffMemberRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class StaffMemberController
 */

class StaffMemberAPIController extends AppBaseController
{
    private StaffMemberRepository $staffMemberRepository;

    public function __construct(StaffMemberRepository $staffMemberRepo)
    {
        $this->staffMemberRepository = $staffMemberRepo;
    }

    /**
     * @OA\Get(
     *      path="/staff-members",
     *      summary="getStaffMemberList",
     *      tags={"StaffMember"},
     *      description="Get all StaffMembers",
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
     *                  @OA\Items(ref="#/components/schemas/StaffMember")
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
        $staffMembers = $this->staffMemberRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($staffMembers->toArray(), 'Staff Members retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/staff-members",
     *      summary="createStaffMember",
     *      tags={"StaffMember"},
     *      description="Create StaffMember",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/StaffMember")
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
     *                  ref="#/components/schemas/StaffMember"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStaffMemberAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $staffMember = $this->staffMemberRepository->create($input);

        return $this->sendResponse($staffMember->toArray(), 'Staff Member saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/staff-members/{id}",
     *      summary="getStaffMemberItem",
     *      tags={"StaffMember"},
     *      description="Get StaffMember",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StaffMember",
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
     *                  ref="#/components/schemas/StaffMember"
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
        /** @var StaffMember $staffMember */
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            return $this->sendError('Staff Member not found');
        }

        return $this->sendResponse($staffMember->toArray(), 'Staff Member retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/staff-members/{id}",
     *      summary="updateStaffMember",
     *      tags={"StaffMember"},
     *      description="Update StaffMember",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StaffMember",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/StaffMember")
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
     *                  ref="#/components/schemas/StaffMember"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStaffMemberAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var StaffMember $staffMember */
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            return $this->sendError('Staff Member not found');
        }

        $staffMember = $this->staffMemberRepository->update($input, $id);

        return $this->sendResponse($staffMember->toArray(), 'StaffMember updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/staff-members/{id}",
     *      summary="deleteStaffMember",
     *      tags={"StaffMember"},
     *      description="Delete StaffMember",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StaffMember",
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
        /** @var StaffMember $staffMember */
        $staffMember = $this->staffMemberRepository->find($id);

        if (empty($staffMember)) {
            return $this->sendError('Staff Member not found');
        }

        $staffMember->delete();

        return $this->sendSuccess('Staff Member deleted successfully');
    }
}
