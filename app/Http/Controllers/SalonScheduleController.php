<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonScheduleRequest;
use App\Http\Requests\UpdateSalonScheduleRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonScheduleRepository;
use Illuminate\Http\Request;
use Flash;

class SalonScheduleController extends AppBaseController
{
    /** @var SalonScheduleRepository $salonScheduleRepository*/
    private $salonScheduleRepository;

    public function __construct(SalonScheduleRepository $salonScheduleRepo)
    {
        $this->salonScheduleRepository = $salonScheduleRepo;
    }

    /**
     * Display a listing of the SalonSchedule.
     */
    public function index(Request $request)
    {
        return view('salon_schedules.index');
    }

    /**
     * Show the form for creating a new SalonSchedule.
     */
    public function create()
    {
        return view('salon_schedules.create');
    }

    /**
     * Store a newly created SalonSchedule in storage.
     */
    public function store(CreateSalonScheduleRequest $request)
    {
        $input = $request->all();

        $salonSchedule = $this->salonScheduleRepository->create($input);

        Flash::success('Salon Schedule saved successfully.');

        return redirect(route('salon-schedules.index'));
    }

    /**
     * Display the specified SalonSchedule.
     */
    public function show($id)
    {
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            Flash::error('Salon Schedule not found');

            return redirect(route('salon-schedules.index'));
        }

        return view('salon_schedules.show')->with('salonSchedule', $salonSchedule);
    }

    /**
     * Show the form for editing the specified SalonSchedule.
     */
    public function edit($id)
    {
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            Flash::error('Salon Schedule not found');

            return redirect(route('salon-schedules.index'));
        }

        return view('salon_schedules.edit')->with('salonSchedule', $salonSchedule);
    }

    /**
     * Update the specified SalonSchedule in storage.
     */
    public function update($id, UpdateSalonScheduleRequest $request)
    {
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            Flash::error('Salon Schedule not found');

            return redirect(route('salon-schedules.index'));
        }

        $salonSchedule = $this->salonScheduleRepository->update($request->all(), $id);

        Flash::success('Salon Schedule updated successfully.');

        return redirect(route('salon-schedules.index'));
    }

    /**
     * Remove the specified SalonSchedule from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonSchedule = $this->salonScheduleRepository->find($id);

        if (empty($salonSchedule)) {
            Flash::error('Salon Schedule not found');

            return redirect(route('salon-schedules.index'));
        }

        $this->salonScheduleRepository->delete($id);

        Flash::success('Salon Schedule deleted successfully.');

        return redirect(route('salon-schedules.index'));
    }
}
