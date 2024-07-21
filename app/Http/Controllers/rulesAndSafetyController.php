<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterulesAndSafetyRequest;
use App\Http\Requests\UpdaterulesAndSafetyRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rulesAndSafetyRepository;
use Illuminate\Http\Request;
use Flash;

class rulesAndSafetyController extends AppBaseController
{
    /** @var rulesAndSafetyRepository $rulesAndSafetyRepository*/
    private $rulesAndSafetyRepository;

    public function __construct(rulesAndSafetyRepository $rulesAndSafetyRepo)
    {
        $this->rulesAndSafetyRepository = $rulesAndSafetyRepo;
    }

    /**
     * Display a listing of the rulesAndSafety.
     */
    public function index(Request $request)
    {
        return view('rules_and_safeties.index');
    }

    /**
     * Show the form for creating a new rulesAndSafety.
     */
    public function create()
    {
        return view('rules_and_safeties.create');
    }

    /**
     * Store a newly created rulesAndSafety in storage.
     */
    public function store(CreaterulesAndSafetyRequest $request)
    {
        $input = $request->all();

        $rulesAndSafety = $this->rulesAndSafetyRepository->create($input);

        Flash::success('Rules And Safety saved successfully.');

        return redirect(route('dash.rulesAndSafeties.index'));
    }

    /**
     * Display the specified rulesAndSafety.
     */
    public function show($id)
    {
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            Flash::error('Rules And Safety not found');

            return redirect(route('dash.rulesAndSafeties.index'));
        }

        return view('rules_and_safeties.show')->with('rulesAndSafety', $rulesAndSafety);
    }

    /**
     * Show the form for editing the specified rulesAndSafety.
     */
    public function edit($id)
    {
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            Flash::error('Rules And Safety not found');

            return redirect(route('dash.rulesAndSafeties.index'));
        }

        return view('rules_and_safeties.edit')->with('rulesAndSafety', $rulesAndSafety);
    }

    /**
     * Update the specified rulesAndSafety in storage.
     */
    public function update($id, UpdaterulesAndSafetyRequest $request)
    {
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            Flash::error('Rules And Safety not found');

            return redirect(route('dash.rulesAndSafeties.index'));
        }

        $rulesAndSafety = $this->rulesAndSafetyRepository->update($request->all(), $id);

        Flash::success('Rules And Safety updated successfully.');

        return redirect(route('dash.rulesAndSafeties.index'));
    }

    /**
     * Remove the specified rulesAndSafety from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rulesAndSafety = $this->rulesAndSafetyRepository->find($id);

        if (empty($rulesAndSafety)) {
            Flash::error('Rules And Safety not found');

            return redirect(route('dash.rulesAndSafeties.index'));
        }

        $this->rulesAndSafetyRepository->delete($id);

        Flash::success('Rules And Safety deleted successfully.');

        return redirect(route('dash.rulesAndSafeties.index'));
    }
}
