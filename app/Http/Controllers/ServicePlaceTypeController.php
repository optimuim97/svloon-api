<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServicePlaceTypeRequest;
use App\Http\Requests\UpdateServicePlaceTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServicePlaceTypeRepository;
use Illuminate\Http\Request;
use Flash;

class ServicePlaceTypeController extends AppBaseController
{
    /** @var ServicePlaceTypeRepository $servicePlaceTypeRepository*/
    private $servicePlaceTypeRepository;

    public function __construct(ServicePlaceTypeRepository $servicePlaceTypeRepo)
    {
        $this->servicePlaceTypeRepository = $servicePlaceTypeRepo;
    }

    /**
     * Display a listing of the ServicePlaceType.
     */
    public function index(Request $request)
    {
        return view('service_place_types.index');
    }

    /**
     * Show the form for creating a new ServicePlaceType.
     */
    public function create()
    {
        return view('service_place_types.create');
    }

    /**
     * Store a newly created ServicePlaceType in storage.
     */
    public function store(CreateServicePlaceTypeRequest $request)
    {
        $input = $request->all();

        $servicePlaceType = $this->servicePlaceTypeRepository->create($input);

        Flash::success('Service Place Type saved successfully.');

        return redirect(route('service-place-types.index'));
    }

    /**
     * Display the specified ServicePlaceType.
     */
    public function show($id)
    {
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            Flash::error('Service Place Type not found');

            return redirect(route('service-place-types.index'));
        }

        return view('service_place_types.show')->with('servicePlaceType', $servicePlaceType);
    }

    /**
     * Show the form for editing the specified ServicePlaceType.
     */
    public function edit($id)
    {
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            Flash::error('Service Place Type not found');

            return redirect(route('service-place-types.index'));
        }

        return view('service_place_types.edit')->with('servicePlaceType', $servicePlaceType);
    }

    /**
     * Update the specified ServicePlaceType in storage.
     */
    public function update($id, UpdateServicePlaceTypeRequest $request)
    {
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            Flash::error('Service Place Type not found');

            return redirect(route('service-place-types.index'));
        }

        $servicePlaceType = $this->servicePlaceTypeRepository->update($request->all(), $id);

        Flash::success('Service Place Type updated successfully.');

        return redirect(route('service-place-types.index'));
    }

    /**
     * Remove the specified ServicePlaceType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicePlaceType = $this->servicePlaceTypeRepository->find($id);

        if (empty($servicePlaceType)) {
            Flash::error('Service Place Type not found');

            return redirect(route('service-place-types.index'));
        }

        $this->servicePlaceTypeRepository->delete($id);

        Flash::success('Service Place Type deleted successfully.');

        return redirect(route('service-place-types.index'));
    }
}
