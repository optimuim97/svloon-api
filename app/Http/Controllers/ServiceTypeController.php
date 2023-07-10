<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceTypeRequest;
use App\Http\Requests\UpdateServiceTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServiceTypeRepository;
use Illuminate\Http\Request;
use Flash;

class ServiceTypeController extends AppBaseController
{
    /** @var ServiceTypeRepository $serviceTypeRepository*/
    private $serviceTypeRepository;

    public function __construct(ServiceTypeRepository $serviceTypeRepo)
    {
        $this->serviceTypeRepository = $serviceTypeRepo;
    }

    /**
     * Display a listing of the ServiceType.
     */
    public function index(Request $request)
    {
        return view('service_types.index');
    }

    /**
     * Show the form for creating a new ServiceType.
     */
    public function create()
    {
        return view('service_types.create');
    }

    /**
     * Store a newly created ServiceType in storage.
     */
    public function store(CreateServiceTypeRequest $request)
    {
        $input = $request->all();

        $serviceType = $this->serviceTypeRepository->create($input);

        Flash::success('Service Type saved successfully.');

        return redirect(route('serviceTypes.index'));
    }

    /**
     * Display the specified ServiceType.
     */
    public function show($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        return view('service_types.show')->with('serviceType', $serviceType);
    }

    /**
     * Show the form for editing the specified ServiceType.
     */
    public function edit($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        return view('service_types.edit')->with('serviceType', $serviceType);
    }

    /**
     * Update the specified ServiceType in storage.
     */
    public function update($id, UpdateServiceTypeRequest $request)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        $serviceType = $this->serviceTypeRepository->update($request->all(), $id);

        Flash::success('Service Type updated successfully.');

        return redirect(route('serviceTypes.index'));
    }

    /**
     * Remove the specified ServiceType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceType = $this->serviceTypeRepository->find($id);

        if (empty($serviceType)) {
            Flash::error('Service Type not found');

            return redirect(route('serviceTypes.index'));
        }

        $this->serviceTypeRepository->delete($id);

        Flash::success('Service Type deleted successfully.');

        return redirect(route('serviceTypes.index'));
    }
}
