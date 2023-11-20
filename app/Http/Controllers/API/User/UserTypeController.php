<?php

namespace App\Http\Controllers\API\User;

use App\Http\Requests\CreateUserTypeRequest;
use App\Http\Requests\UpdateUserTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserTypeRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;

class UserTypeController extends AppBaseController
{
    /** @var UserTypeRepository $userTypeRepository*/
    private $userTypeRepository;

    public function __construct(UserTypeRepository $userTypeRepo)
    {
        $this->userTypeRepository = $userTypeRepo;
    }

    /**
     * Display a listing of the UserType.
     */
    public function index(Request $request)
    {
        return view('user_types.index');
    }

    /**
     * Show the form for creating a new UserType.
     */
    public function create()
    {
        return view('user_types.create');
    }

    /**
     * Store a newly created UserType in storage.
     */
    public function store(CreateUserTypeRequest $request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['label']);

        $userType = $this->userTypeRepository->create($input);

        Flash::success('User Type saved successfully.');

        return redirect(route('user-types.index'));
    }

    /**
     * Display the specified UserType.
     */
    public function show($id)
    {
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            Flash::error('User Type not found');

            return redirect(route('user-types.index'));
        }

        return view('user_types.show')->with('userType', $userType);
    }

    /**
     * Show the form for editing the specified UserType.
     */
    public function edit($id)
    {
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            Flash::error('User Type not found');

            return redirect(route('user-types.index'));
        }

        return view('user_types.edit')->with('userType', $userType);
    }

    /**
     * Update the specified UserType in storage.
     */
    public function update($id, UpdateUserTypeRequest $request)
    {
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            Flash::error('User Type not found');

            return redirect(route('user-types.index'));
        }

        $userType = $this->userTypeRepository->update($request->all(), $id);

        Flash::success('User Type updated successfully.');

        return redirect(route('user-types.index'));
    }

    /**
     * Remove the specified UserType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            Flash::error('User Type not found');

            return redirect(route('user-types.index'));
        }

        $this->userTypeRepository->delete($id);

        Flash::success('User Type deleted successfully.');

        return redirect(route('user-types.index'));
    }
}
