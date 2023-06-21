<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonRequest;
use App\Http\Requests\UpdateSalonRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonRepository;
use Illuminate\Http\Request;
use Flash;

class SalonController extends AppBaseController
{
    /** @var SalonRepository $salonRepository*/
    private $salonRepository;

    public function __construct(SalonRepository $salonRepo)
    {
        $this->salonRepository = $salonRepo;
    }

    /**
     * Display a listing of the Salon.
     */
    public function index(Request $request)
    {
        return view('salons.index');
    }

    /**
     * Show the form for creating a new Salon.
     */
    public function create()
    {
        return view('salons.create');
    }

    /**
     * Store a newly created Salon in storage.
     */
    public function store(CreateSalonRequest $request)
    {
        $input = $request->all();

        $salon = $this->salonRepository->create($input);

        Flash::success('Salon saved successfully.');

        return redirect(route('salons.index'));
    }

    /**
     * Display the specified Salon.
     */
    public function show($id)
    {
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            Flash::error('Salon not found');

            return redirect(route('salons.index'));
        }

        return view('salons.show')->with('salon', $salon);
    }

    /**
     * Show the form for editing the specified Salon.
     */
    public function edit($id)
    {
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            Flash::error('Salon not found');

            return redirect(route('salons.index'));
        }

        return view('salons.edit')->with('salon', $salon);
    }

    /**
     * Update the specified Salon in storage.
     */
    public function update($id, UpdateSalonRequest $request)
    {
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            Flash::error('Salon not found');

            return redirect(route('salons.index'));
        }

        $salon = $this->salonRepository->update($request->all(), $id);

        Flash::success('Salon updated successfully.');

        return redirect(route('salons.index'));
    }

    /**
     * Remove the specified Salon from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salon = $this->salonRepository->find($id);

        if (empty($salon)) {
            Flash::error('Salon not found');

            return redirect(route('salons.index'));
        }

        $this->salonRepository->delete($id);

        Flash::success('Salon deleted successfully.');

        return redirect(route('salons.index'));
    }
}
