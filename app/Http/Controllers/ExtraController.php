<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExtraRequest;
use App\Http\Requests\UpdateExtraRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ExtraRepository;
use Illuminate\Http\Request;
use Flash;

class ExtraController extends AppBaseController
{
    /** @var ExtraRepository $extraRepository*/
    private $extraRepository;

    public function __construct(ExtraRepository $extraRepo)
    {
        $this->extraRepository = $extraRepo;
    }

    /**
     * Display a listing of the Extra.
     */
    public function index(Request $request)
    {
        return view('extras.index');
    }

    /**
     * Show the form for creating a new Extra.
     */
    public function create()
    {
        return view('extras.create');
    }

    /**
     * Store a newly created Extra in storage.
     */
    public function store(CreateExtraRequest $request)
    {
        $input = $request->all();

        $extra = $this->extraRepository->create($input);

        Flash::success('Extra saved successfully.');

        return redirect(route('extras.index'));
    }

    /**
     * Display the specified Extra.
     */
    public function show($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            Flash::error('Extra not found');

            return redirect(route('extras.index'));
        }

        return view('extras.show')->with('extra', $extra);
    }

    /**
     * Show the form for editing the specified Extra.
     */
    public function edit($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            Flash::error('Extra not found');

            return redirect(route('extras.index'));
        }

        return view('extras.edit')->with('extra', $extra);
    }

    /**
     * Update the specified Extra in storage.
     */
    public function update($id, UpdateExtraRequest $request)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            Flash::error('Extra not found');

            return redirect(route('extras.index'));
        }

        $extra = $this->extraRepository->update($request->all(), $id);

        Flash::success('Extra updated successfully.');

        return redirect(route('extras.index'));
    }

    /**
     * Remove the specified Extra from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            Flash::error('Extra not found');

            return redirect(route('extras.index'));
        }

        $this->extraRepository->delete($id);

        Flash::success('Extra deleted successfully.');

        return redirect(route('extras.index'));
    }
}
