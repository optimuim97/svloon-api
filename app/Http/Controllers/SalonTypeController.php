<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonTypeRequest;
use App\Http\Requests\UpdateSalonTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonTypeRepository;
use Illuminate\Http\Request;
use Flash;

class SalonTypeController extends AppBaseController
{
    /** @var SalonTypeRepository $salonTypeRepository*/
    private $salonTypeRepository;

    public function __construct(SalonTypeRepository $salonTypeRepo)
    {
        $this->salonTypeRepository = $salonTypeRepo;
    }

    /**
     * Display a listing of the SalonType.
     */
    public function index(Request $request)
    {
        return view('salon_types.index');
    }

    /**
     * Show the form for creating a new SalonType.
     */
    public function create()
    {
        return view('salon_types.create');
    }

    /**
     * Store a newly created SalonType in storage.
     */
    public function store(CreateSalonTypeRequest $request)
    {
        $input = $request->all();

        $salonType = $this->salonTypeRepository->create($input);

        Flash::success('Salon Type saved successfully.');

        return redirect(route('salon-types.index'));
    }

    /**
     * Display the specified SalonType.
     */
    public function show($id)
    {
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            Flash::error('Salon Type not found');

            return redirect(route('salon-types.index'));
        }

        return view('salon_types.show')->with('salonType', $salonType);
    }

    /**
     * Show the form for editing the specified SalonType.
     */
    public function edit($id)
    {
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            Flash::error('Salon Type not found');

            return redirect(route('salon-types.index'));
        }

        return view('salon_types.edit')->with('salonType', $salonType);
    }

    /**
     * Update the specified SalonType in storage.
     */
    public function update($id, UpdateSalonTypeRequest $request)
    {
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            Flash::error('Salon Type not found');

            return redirect(route('salon-types.index'));
        }

        $salonType = $this->salonTypeRepository->update($request->all(), $id);

        Flash::success('Salon Type updated successfully.');

        return redirect(route('salon-types.index'));
    }

    /**
     * Remove the specified SalonType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonType = $this->salonTypeRepository->find($id);

        if (empty($salonType)) {
            Flash::error('Salon Type not found');

            return redirect(route('salon-types.index'));
        }

        $this->salonTypeRepository->delete($id);

        Flash::success('Salon Type deleted successfully.');

        return redirect(route('salon-types.index'));
    }
}
