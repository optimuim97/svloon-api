<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonAddressRequest;
use App\Http\Requests\UpdateSalonAddressRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonAddressRepository;
use Illuminate\Http\Request;
use Flash;

class SalonAddressController extends AppBaseController
{
    /** @var SalonAddressRepository $salonAddressRepository*/
    private $salonAddressRepository;

    public function __construct(SalonAddressRepository $salonAddressRepo)
    {
        $this->salonAddressRepository = $salonAddressRepo;
    }

    /**
     * Display a listing of the SalonAddress.
     */
    public function index(Request $request)
    {
        return view('salon_addresses.index');
    }

    /**
     * Show the form for creating a new SalonAddress.
     */
    public function create()
    {
        return view('salon_addresses.create');
    }

    /**
     * Store a newly created SalonAddress in storage.
     */
    public function store(CreateSalonAddressRequest $request)
    {
        $input = $request->all();

        $salonAddress = $this->salonAddressRepository->create($input);

        Flash::success('Salon Address saved successfully.');

        return redirect(route('salon-addresses.index'));
    }

    /**
     * Display the specified SalonAddress.
     */
    public function show($id)
    {
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            Flash::error('Salon Address not found');

            return redirect(route('salon-addresses.index'));
        }

        return view('salon_addresses.show')->with('salonAddress', $salonAddress);
    }

    /**
     * Show the form for editing the specified SalonAddress.
     */
    public function edit($id)
    {
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            Flash::error('Salon Address not found');

            return redirect(route('salon-addresses.index'));
        }

        return view('salon_addresses.edit')->with('salonAddress', $salonAddress);
    }

    /**
     * Update the specified SalonAddress in storage.
     */
    public function update($id, UpdateSalonAddressRequest $request)
    {
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            Flash::error('Salon Address not found');

            return redirect(route('salon-addresses.index'));
        }

        $salonAddress = $this->salonAddressRepository->update($request->all(), $id);

        Flash::success('Salon Address updated successfully.');

        return redirect(route('salon-addresses.index'));
    }

    /**
     * Remove the specified SalonAddress from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonAddress = $this->salonAddressRepository->find($id);

        if (empty($salonAddress)) {
            Flash::error('Salon Address not found');

            return redirect(route('salon-addresses.index'));
        }

        $this->salonAddressRepository->delete($id);

        Flash::success('Salon Address deleted successfully.');

        return redirect(route('salon-addresses.index'));
    }
}
