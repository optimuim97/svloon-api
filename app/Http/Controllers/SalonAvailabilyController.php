<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonAvailabilyRequest;
use App\Http\Requests\UpdateSalonAvailabilyRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonAvailabilyRepository;
use Illuminate\Http\Request;
use Flash;

class SalonAvailabilyController extends AppBaseController
{
    /** @var SalonAvailabilyRepository $salonAvailabilyRepository*/
    private $salonAvailabilyRepository;

    public function __construct(SalonAvailabilyRepository $salonAvailabilyRepo)
    {
        $this->salonAvailabilyRepository = $salonAvailabilyRepo;
    }

    /**
     * Display a listing of the SalonAvailabily.
     */
    public function index(Request $request)
    {
        return view('salon_availabilies.index');
    }

    /**
     * Show the form for creating a new SalonAvailabily.
     */
    public function create()
    {
        return view('salon_availabilies.create');
    }

    /**
     * Store a newly created SalonAvailabily in storage.
     */
    public function store(CreateSalonAvailabilyRequest $request)
    {
        $input = $request->all();

        $salonAvailabily = $this->salonAvailabilyRepository->create($input);

        Flash::success('Salon Availabily saved successfully.');

        return redirect(route('salon-availabilies.index'));
    }

    /**
     * Display the specified SalonAvailabily.
     */
    public function show($id)
    {
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            Flash::error('Salon Availabily not found');

            return redirect(route('salon-availabilies.index'));
        }

        return view('salon_availabilies.show')->with('salonAvailabily', $salonAvailabily);
    }

    /**
     * Show the form for editing the specified SalonAvailabily.
     */
    public function edit($id)
    {
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            Flash::error('Salon Availabily not found');

            return redirect(route('salon-availabilies.index'));
        }

        return view('salon_availabilies.edit')->with('salonAvailabily', $salonAvailabily);
    }

    /**
     * Update the specified SalonAvailabily in storage.
     */
    public function update($id, UpdateSalonAvailabilyRequest $request)
    {
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            Flash::error('Salon Availabily not found');

            return redirect(route('salon-availabilies.index'));
        }

        $salonAvailabily = $this->salonAvailabilyRepository->update($request->all(), $id);

        Flash::success('Salon Availabily updated successfully.');

        return redirect(route('salon-availabilies.index'));
    }

    /**
     * Remove the specified SalonAvailabily from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonAvailabily = $this->salonAvailabilyRepository->find($id);

        if (empty($salonAvailabily)) {
            Flash::error('Salon Availabily not found');

            return redirect(route('salon-availabilies.index'));
        }

        $this->salonAvailabilyRepository->delete($id);

        Flash::success('Salon Availabily deleted successfully.');

        return redirect(route('salon-availabilies.index'));
    }
}
