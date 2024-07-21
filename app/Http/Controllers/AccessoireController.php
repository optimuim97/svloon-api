<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccessoireRequest;
use App\Http\Requests\UpdateAccessoireRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AccessoireRepository;
use Illuminate\Http\Request;
use Flash;

class AccessoireController extends AppBaseController
{
    /** @var AccessoireRepository $accessoireRepository*/
    private $accessoireRepository;

    public function __construct(AccessoireRepository $accessoireRepo)
    {
        $this->accessoireRepository = $accessoireRepo;
    }

    /**
     * Display a listing of the Accessoire.
     */
    public function index(Request $request)
    {
        return view('accessoires.index');
    }

    /**
     * Show the form for creating a new Accessoire.
     */
    public function create()
    {
        return view('accessoires.create');
    }

    /**
     * Store a newly created Accessoire in storage.
     */
    public function store(CreateAccessoireRequest $request)
    {
        $input = $request->all();
        $input['icone'] = $this->upload($request, 'icone');

       $this->accessoireRepository->create($input);

        Flash::success('Accessoire saved successfully.');

        return redirect(route('dash.accessoires.index'));
    }

    /**
     * Display the specified Accessoire.
     */
    public function show($id)
    {
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            Flash::error('Accessoire not found');

            return redirect(route('dash.accessoires.index'));
        }

        return view('accessoires.show')->with('accessoire', $accessoire);
    }

    /**
     * Show the form for editing the specified Accessoire.
     */
    public function edit($id)
    {
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            Flash::error('Accessoire not found');

            return redirect(route('dash.accessoires.index'));
        }

        return view('accessoires.edit')->with('accessoire', $accessoire);
    }

    /**
     * Update the specified Accessoire in storage.
     */
    public function update($id, UpdateAccessoireRequest $request)
    {
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            Flash::error('Accessoire not found');

            return redirect(route('dash.accessoires.index'));
        }

        $accessoire = $this->accessoireRepository->update($request->all(), $id);

        Flash::success('Accessoire updated successfully.');

        return redirect(route('dash.accessoires.index'));
    }

    /**
     * Remove the specified Accessoire from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accessoire = $this->accessoireRepository->find($id);

        if (empty($accessoire)) {
            Flash::error('Accessoire not found');

            return redirect(route('dash.accessoires.index'));
        }

        $this->accessoireRepository->delete($id);

        Flash::success('Accessoire deleted successfully.');

        return redirect(route('dash.accessoires.index'));
    }
}
