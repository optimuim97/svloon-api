<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuickServiceRequest;
use App\Http\Requests\UpdateQuickServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\QuickServiceRepository;
use Illuminate\Http\Request;
use Flash;

class QuickServiceController extends AppBaseController
{
    /** @var QuickServiceRepository $quickServiceRepository*/
    private $quickServiceRepository;

    public function __construct(QuickServiceRepository $quickServiceRepo)
    {
        $this->quickServiceRepository = $quickServiceRepo;
    }

    /**
     * Display a listing of the QuickService.
     */
    public function index(Request $request)
    {
        return view('quick_services.index');
    }

    /**
     * Show the form for creating a new QuickService.
     */
    public function create()
    {
        return view('quick_services.create');
    }

    /**
     * Store a newly created QuickService in storage.
     */
    public function store(CreateQuickServiceRequest $request)
    {
        $input = $request->all();

        $quickService = $this->quickServiceRepository->create($input);

        Flash::success('Quick Service saved successfully.');

        return redirect(route('quickServices.index'));
    }

    /**
     * Display the specified QuickService.
     */
    public function show($id)
    {
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            Flash::error('Quick Service not found');

            return redirect(route('quickServices.index'));
        }

        return view('quick_services.show')->with('quickService', $quickService);
    }

    /**
     * Show the form for editing the specified QuickService.
     */
    public function edit($id)
    {
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            Flash::error('Quick Service not found');

            return redirect(route('quickServices.index'));
        }

        return view('quick_services.edit')->with('quickService', $quickService);
    }

    /**
     * Update the specified QuickService in storage.
     */
    public function update($id, UpdateQuickServiceRequest $request)
    {
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            Flash::error('Quick Service not found');

            return redirect(route('quickServices.index'));
        }

        $quickService = $this->quickServiceRepository->update($request->all(), $id);

        Flash::success('Quick Service updated successfully.');

        return redirect(route('quickServices.index'));
    }

    /**
     * Remove the specified QuickService from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $quickService = $this->quickServiceRepository->find($id);

        if (empty($quickService)) {
            Flash::error('Quick Service not found');

            return redirect(route('quickServices.index'));
        }

        $this->quickServiceRepository->delete($id);

        Flash::success('Quick Service deleted successfully.');

        return redirect(route('quickServices.index'));
    }
}
