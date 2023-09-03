<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentStatusRequest;
use App\Http\Requests\UpdateAppointmentStatusRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AppointmentStatusRepository;
use Illuminate\Http\Request;
use Flash;

class AppointmentStatusController extends AppBaseController
{
    /** @var AppointmentStatusRepository $appointmentStatusRepository*/
    private $appointmentStatusRepository;

    public function __construct(AppointmentStatusRepository $appointmentStatusRepo)
    {
        $this->appointmentStatusRepository = $appointmentStatusRepo;
    }

    /**
     * Display a listing of the AppointmentStatus.
     */
    public function index(Request $request)
    {
        return view('appointment_statuses.index');
    }

    /**
     * Show the form for creating a new AppointmentStatus.
     */
    public function create()
    {
        return view('appointment_statuses.create');
    }

    /**
     * Store a newly created AppointmentStatus in storage.
     */
    public function store(CreateAppointmentStatusRequest $request)
    {
        $input = $request->all();

        $appointmentStatus = $this->appointmentStatusRepository->create($input);

        Flash::success('Appointment Status saved successfully.');

        return redirect(route('appointmentStatuses.index'));
    }

    /**
     * Display the specified AppointmentStatus.
     */
    public function show($id)
    {
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            Flash::error('Appointment Status not found');

            return redirect(route('appointmentStatuses.index'));
        }

        return view('appointment_statuses.show')->with('appointmentStatus', $appointmentStatus);
    }

    /**
     * Show the form for editing the specified AppointmentStatus.
     */
    public function edit($id)
    {
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            Flash::error('Appointment Status not found');

            return redirect(route('appointmentStatuses.index'));
        }

        return view('appointment_statuses.edit')->with('appointmentStatus', $appointmentStatus);
    }

    /**
     * Update the specified AppointmentStatus in storage.
     */
    public function update($id, UpdateAppointmentStatusRequest $request)
    {
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            Flash::error('Appointment Status not found');

            return redirect(route('appointmentStatuses.index'));
        }

        $appointmentStatus = $this->appointmentStatusRepository->update($request->all(), $id);

        Flash::success('Appointment Status updated successfully.');

        return redirect(route('appointmentStatuses.index'));
    }

    /**
     * Remove the specified AppointmentStatus from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $appointmentStatus = $this->appointmentStatusRepository->find($id);

        if (empty($appointmentStatus)) {
            Flash::error('Appointment Status not found');

            return redirect(route('appointmentStatuses.index'));
        }

        $this->appointmentStatusRepository->delete($id);

        Flash::success('Appointment Status deleted successfully.');

        return redirect(route('appointmentStatuses.index'));
    }
}
