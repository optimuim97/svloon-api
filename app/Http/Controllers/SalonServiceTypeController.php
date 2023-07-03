<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonServiceTypeRequest;
use App\Http\Requests\UpdateSalonServiceTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonServiceTypeRepository;
use Illuminate\Http\Request;
use Flash;

class SalonServiceTypeController extends AppBaseController
{
    /** @var SalonServiceTypeRepository $salonServiceTypeRepository*/
    private $salonServiceTypeRepository;

    public function __construct(SalonServiceTypeRepository $salonServiceTypeRepo)
    {
        $this->salonServiceTypeRepository = $salonServiceTypeRepo;
    }

    /**
     * Display a listing of the SalonServiceType.
     */
    public function index(Request $request)
    {
        return view('salon_service_types.index');
    }

    /**
     * Show the form for creating a new SalonServiceType.
     */
    public function create()
    {
        return view('salon_service_types.create');
    }

    /**
     * Store a newly created SalonServiceType in storage.
     */
    public function store(CreateSalonServiceTypeRequest $request)
    {
        $input = $request->all();

        $salonServiceType = $this->salonServiceTypeRepository->create($input);

        Flash::success('Salon Service Type saved successfully.');

        return redirect(route('salonServiceTypes.index'));
    }

    /**
     * Display the specified SalonServiceType.
     */
    public function show($id)
    {
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            Flash::error('Salon Service Type not found');

            return redirect(route('salonServiceTypes.index'));
        }

        return view('salon_service_types.show')->with('salonServiceType', $salonServiceType);
    }

    /**
     * Show the form for editing the specified SalonServiceType.
     */
    public function edit($id)
    {
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            Flash::error('Salon Service Type not found');

            return redirect(route('salonServiceTypes.index'));
        }

        return view('salon_service_types.edit')->with('salonServiceType', $salonServiceType);
    }

    /**
     * Update the specified SalonServiceType in storage.
     */
    public function update($id, UpdateSalonServiceTypeRequest $request)
    {
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            Flash::error('Salon Service Type not found');

            return redirect(route('salonServiceTypes.index'));
        }

        $salonServiceType = $this->salonServiceTypeRepository->update($request->all(), $id);

        Flash::success('Salon Service Type updated successfully.');

        return redirect(route('salonServiceTypes.index'));
    }

    /**
     * Remove the specified SalonServiceType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonServiceType = $this->salonServiceTypeRepository->find($id);

        if (empty($salonServiceType)) {
            Flash::error('Salon Service Type not found');

            return redirect(route('salonServiceTypes.index'));
        }

        $this->salonServiceTypeRepository->delete($id);

        Flash::success('Salon Service Type deleted successfully.');

        return redirect(route('salonServiceTypes.index'));
    }
}
