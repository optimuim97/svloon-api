<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConvenienceRequest;
use App\Http\Requests\UpdateConvenienceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ConvenienceRepository;
use Illuminate\Http\Request;
use Flash;

class ConvenienceController extends AppBaseController
{
    /** @var ConvenienceRepository $convenienceRepository*/
    private $convenienceRepository;

    public function __construct(ConvenienceRepository $convenienceRepo)
    {
        $this->convenienceRepository = $convenienceRepo;
    }

    /**
     * Display a listing of the Convenience.
     */
    public function index(Request $request)
    {
        return view('conveniences.index');
    }

    /**
     * Show the form for creating a new Convenience.
     */
    public function create()
    {
        return view('conveniences.create');
    }

    /**
     * Store a newly created Convenience in storage.
     */
    public function store(CreateConvenienceRequest $request)
    {
        $input = $request->all();

        $convenience = $this->convenienceRepository->create($input);

        Flash::success('Convenience saved successfully.');

        return redirect(route('conveniences.index'));
    }

    /**
     * Display the specified Convenience.
     */
    public function show($id)
    {
        $convenience = $this->convenienceRepository->find($id);

        if (empty($convenience)) {
            Flash::error('Convenience not found');

            return redirect(route('conveniences.index'));
        }

        return view('conveniences.show')->with('convenience', $convenience);
    }

    /**
     * Show the form for editing the specified Convenience.
     */
    public function edit($id)
    {
        $convenience = $this->convenienceRepository->find($id);

        if (empty($convenience)) {
            Flash::error('Convenience not found');

            return redirect(route('conveniences.index'));
        }

        return view('conveniences.edit')->with('convenience', $convenience);
    }

    /**
     * Update the specified Convenience in storage.
     */
    public function update($id, UpdateConvenienceRequest $request)
    {
        $convenience = $this->convenienceRepository->find($id);

        if (empty($convenience)) {
            Flash::error('Convenience not found');

            return redirect(route('conveniences.index'));
        }

        $convenience = $this->convenienceRepository->update($request->all(), $id);

        Flash::success('Convenience updated successfully.');

        return redirect(route('conveniences.index'));
    }

    /**
     * Remove the specified Convenience from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $convenience = $this->convenienceRepository->find($id);

        if (empty($convenience)) {
            Flash::error('Convenience not found');

            return redirect(route('conveniences.index'));
        }

        $this->convenienceRepository->delete($id);

        Flash::success('Convenience deleted successfully.');

        return redirect(route('conveniences.index'));
    }
}
