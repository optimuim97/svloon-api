<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonUnAvailabilyRequest;
use App\Http\Requests\UpdateSalonUnAvailabilyRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonUnAvailabilyRepository;
use Illuminate\Http\Request;
use Flash;

class SalonUnAvailabilyController extends AppBaseController
{
    /** @var SalonUnAvailabilyRepository $salonUnAvailabilyRepository*/
    private $salonUnAvailabilyRepository;

    public function __construct(SalonUnAvailabilyRepository $salonUnAvailabilyRepo)
    {
        $this->salonUnAvailabilyRepository = $salonUnAvailabilyRepo;
    }

    /**
     * Display a listing of the SalonUnAvailabily.
     */
    public function index(Request $request)
    {
        return view('salon_un_availabilies.index');
    }

    /**
     * Show the form for creating a new SalonUnAvailabily.
     */
    public function create()
    {
        return view('salon_un_availabilies.create');
    }

    /**
     * Store a newly created SalonUnAvailabily in storage.
     */
    public function store(CreateSalonUnAvailabilyRequest $request)
    {
        $input = $request->all();

        $salonUnAvailabily = $this->salonUnAvailabilyRepository->create($input);

        Flash::success('Salon Un Availabily saved successfully.');

        return redirect(route('salon-un-availabilies.index'));
    }

    /**
     * Display the specified SalonUnAvailabily.
     */
    public function show($id)
    {
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            Flash::error('Salon Un Availabily not found');

            return redirect(route('salon-un-availabilies.index'));
        }

        return view('salon_un_availabilies.show')->with('salonUnAvailabily', $salonUnAvailabily);
    }

    /**
     * Show the form for editing the specified SalonUnAvailabily.
     */
    public function edit($id)
    {
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            Flash::error('Salon Un Availabily not found');

            return redirect(route('salon-un-availabilies.index'));
        }

        return view('salon_un_availabilies.edit')->with('salonUnAvailabily', $salonUnAvailabily);
    }

    /**
     * Update the specified SalonUnAvailabily in storage.
     */
    public function update($id, UpdateSalonUnAvailabilyRequest $request)
    {
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            Flash::error('Salon Un Availabily not found');

            return redirect(route('salon-un-availabilies.index'));
        }

        $salonUnAvailabily = $this->salonUnAvailabilyRepository->update($request->all(), $id);

        Flash::success('Salon Un Availabily updated successfully.');

        return redirect(route('salon-un-availabilies.index'));
    }

    /**
     * Remove the specified SalonUnAvailabily from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonUnAvailabily = $this->salonUnAvailabilyRepository->find($id);

        if (empty($salonUnAvailabily)) {
            Flash::error('Salon Un Availabily not found');

            return redirect(route('salon-un-availabilies.index'));
        }

        $this->salonUnAvailabilyRepository->delete($id);

        Flash::success('Salon Un Availabily deleted successfully.');

        return redirect(route('salon-un-availabilies.index'));
    }
}
