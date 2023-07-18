<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServicesSalonRequest;
use App\Http\Requests\UpdateServicesSalonRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServicesSalonRepository;
use Illuminate\Http\Request;
use Flash;

class ServicesSalonController extends AppBaseController
{
    /** @var ServicesSalonRepository $servicesSalonRepository*/
    private $servicesSalonRepository;

    public function __construct(ServicesSalonRepository $servicesSalonRepo)
    {
        $this->servicesSalonRepository = $servicesSalonRepo;
    }

    /**
     * Display a listing of the ServicesSalon.
     */
    public function index(Request $request)
    {
        return view('services_salons.index');
    }

    /**
     * Show the form for creating a new ServicesSalon.
     */
    public function create()
    {
        return view('services_salons.create');
    }

    /**
     * Store a newly created ServicesSalon in storage.
     */
    public function store(CreateServicesSalonRequest $request)
    {
        $input = $request->all();

        $servicesSalon = $this->servicesSalonRepository->create($input);

        Flash::success('Services Salon saved successfully.');

        return redirect(route('services-salonss.index'));
    }

    /**
     * Display the specified ServicesSalon.
     */
    public function show($id)
    {
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            Flash::error('Services Salon not found');

            return redirect(route('services-salons.index'));
        }

        return view('services_salons.show')->with('servicesSalon', $servicesSalon);
    }

    /**
     * Show the form for editing the specified ServicesSalon.
     */
    public function edit($id)
    {
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            Flash::error('Services Salon not found');

            return redirect(route('services-salons.index'));
        }

        return view('services_salons.edit')->with('servicesSalon', $servicesSalon);
    }

    /**
     * Update the specified ServicesSalon in storage.
     */
    public function update($id, UpdateServicesSalonRequest $request)
    {
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            Flash::error('Services Salon not found');

            return redirect(route('services-salons.index'));
        }

        $servicesSalon = $this->servicesSalonRepository->update($request->all(), $id);

        Flash::success('Services Salon updated successfully.');

        return redirect(route('services-salons.index'));
    }

    /**
     * Remove the specified ServicesSalon from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicesSalon = $this->servicesSalonRepository->find($id);

        if (empty($servicesSalon)) {
            Flash::error('Services Salon not found');

            return redirect(route('services-salons.index'));
        }

        $this->servicesSalonRepository->delete($id);

        Flash::success('Services Salon deleted successfully.');

        return redirect(route('services-salons.index'));
    }
}
