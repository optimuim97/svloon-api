<?php

namespace App\Http\Controllers\API\User;

use App\Http\Requests\CreateUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;
use Flash;

class UserAddressController extends AppBaseController
{
    /** @var UserAddressRepository $userAddressRepository*/
    private $userAddressRepository;

    public function __construct(UserAddressRepository $userAddressRepo)
    {
        $this->userAddressRepository = $userAddressRepo;
    }

    /**
     * Display a listing of the UserAddress.
     */
    public function index(Request $request)
    {
        return view('user_addresses.index');
    }

    /**
     * Show the form for creating a new UserAddress.
     */
    public function create()
    {
        return view('user_addresses.create');
    }

    /**
     * Store a newly created UserAddress in storage.
     */
    public function store(CreateUserAddressRequest $request)
    {
        $input = $request->all();

        $userAddress = $this->userAddressRepository->create($input);

        Flash::success('User Address saved successfully.');

        return redirect(route('user-addresses.index'));
    }

    /**
     * Display the specified UserAddress.
     */
    public function show($id)
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('user-addresses.index'));
        }

        return view('user_addresses.show')->with('userAddress', $userAddress);
    }

    /**
     * Show the form for editing the specified UserAddress.
     */
    public function edit($id)
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('user-addresses.index'));
        }

        return view('user_addresses.edit')->with('userAddress', $userAddress);
    }

    /**
     * Update the specified UserAddress in storage.
     */
    public function update($id, UpdateUserAddressRequest $request)
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('user-addresses.index'));
        }

        $userAddress = $this->userAddressRepository->update($request->all(), $id);

        Flash::success('User Address updated successfully.');

        return redirect(route('user-addresses.index'));
    }

    /**
     * Remove the specified UserAddress from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (empty($userAddress)) {
            Flash::error('User Address not found');

            return redirect(route('user-addresses.index'));
        }

        $this->userAddressRepository->delete($id);

        Flash::success('User Address deleted successfully.');

        return redirect(route('user-addresses.index'));
    }
}
