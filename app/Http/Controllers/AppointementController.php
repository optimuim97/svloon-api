<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointementRequest;
use App\Http\Requests\UpdateAppointementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AppointementRepository;
use Illuminate\Http\Request;
use Flash;

class AppointementController extends AppBaseController
{
    /** @var AppointementRepository $appointementRepository*/
    private $appointementRepository;

    public function __construct(AppointementRepository $appointementRepo)
    {
        $this->appointementRepository = $appointementRepo;
    }

    /**
     * Display a listing of the Appointement.
     */
    public function index(Request $request)
    {
        return view('appointements.index');
    }

    /**
     * Show the form for creating a new Appointement.
     */
    public function create()
    {
        return view('appointements.create');
    }

    /**
     * Store a newly created Appointement in storage.
     */
    public function store(CreateAppointementRequest $request)
    {
        $input = $request->all();

        $appointement = $this->appointementRepository->create($input);

        Flash::success('Appointement saved successfully.');

        return redirect(route('appointements.index'));
    }

    /**
     * Display the specified Appointement.
     */
    public function show($id)
    {
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            Flash::error('Appointement not found');

            return redirect(route('appointements.index'));
        }

        return view('appointements.show')->with('appointement', $appointement);
    }

    /**
     * Show the form for editing the specified Appointement.
     */
    public function edit($id)
    {
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            Flash::error('Appointement not found');

            return redirect(route('appointements.index'));
        }

        return view('appointements.edit')->with('appointement', $appointement);
    }

    /**
     * Update the specified Appointement in storage.
     */
    public function update($id, UpdateAppointementRequest $request)
    {
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            Flash::error('Appointement not found');

            return redirect(route('appointements.index'));
        }

        $appointement = $this->appointementRepository->update($request->all(), $id);

        Flash::success('Appointement updated successfully.');

        return redirect(route('appointements.index'));
    }

    /**
     * Remove the specified Appointement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $appointement = $this->appointementRepository->find($id);

        if (empty($appointement)) {
            Flash::error('Appointement not found');

            return redirect(route('appointements.index'));
        }

        $this->appointementRepository->delete($id);

        Flash::success('Appointement deleted successfully.');

        return redirect(route('appointements.index'));
    }
}
