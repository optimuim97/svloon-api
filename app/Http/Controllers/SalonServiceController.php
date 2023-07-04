<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonServiceRequest;
use App\Http\Requests\UpdateSalonServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonServiceRepository;
use Illuminate\Http\Request;
use Flash;

class SalonServiceController extends AppBaseController
{
    /** @var SalonServiceRepository $salonServiceRepository*/
    private $salonServiceRepository;

    public function __construct(SalonServiceRepository $salonServiceRepo)
    {
        $this->salonServiceRepository = $salonServiceRepo;
    }

    /**
     * Display a listing of the SalonService.
     */
    public function index(Request $request)
    {
        return view('salon_services.index');
    }

    /**
     * Show the form for creating a new SalonService.
     */
    public function create()
    {
        return view('salon_services.create');
    }

    /**
     * Store a newly created SalonService in storage.
     */
    public function store(CreateSalonServiceRequest $request)
    {
        $input = $request->all();

        $salonService = $this->salonServiceRepository->create($input);

        Flash::success('Salon Service saved successfully.');

        return redirect(route('salon-services.index'));
    }

    /**
     * Display the specified SalonService.
     */
    public function show($id)
    {
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            Flash::error('Salon Service not found');

            return redirect(route('salon-services.index'));
        }

        return view('salon_services.show')->with('salonService', $salonService);
    }

    /**
     * Show the form for editing the specified SalonService.
     */
    public function edit($id)
    {
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            Flash::error('Salon Service not found');

            return redirect(route('salon-services.index'));
        }

        return view('salon_services.edit')->with('salonService', $salonService);
    }

    /**
     * Update the specified SalonService in storage.
     */
    public function update($id, UpdateSalonServiceRequest $request)
    {
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            Flash::error('Salon Service not found');

            return redirect(route('salon-services.index'));
        }

        $salonService = $this->salonServiceRepository->update($request->all(), $id);

        Flash::success('Salon Service updated successfully.');

        return redirect(route('salon-services.index'));
    }

    /**
     * Remove the specified SalonService from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonService = $this->salonServiceRepository->find($id);

        if (empty($salonService)) {
            Flash::error('Salon Service not found');

            return redirect(route('salon-services.index'));
        }

        $this->salonServiceRepository->delete($id);

        Flash::success('Salon Service deleted successfully.');

        return redirect(route('salon-services.index'));
    }
}
