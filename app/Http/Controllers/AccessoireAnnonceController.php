<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccessoireAnnonceRequest;
use App\Http\Requests\UpdateAccessoireAnnonceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AccessoireAnnonceRepository;
use Illuminate\Http\Request;
use Flash;

class AccessoireAnnonceController extends AppBaseController
{
    /** @var AccessoireAnnonceRepository $accessoireAnnonceRepository*/
    private $accessoireAnnonceRepository;

    public function __construct(AccessoireAnnonceRepository $accessoireAnnonceRepo)
    {
        $this->accessoireAnnonceRepository = $accessoireAnnonceRepo;
    }

    /**
     * Display a listing of the AccessoireAnnonce.
     */
    public function index(Request $request)
    {
        return view('accessoire_annonces.index');
    }

    /**
     * Show the form for creating a new AccessoireAnnonce.
     */
    public function create()
    {
        return view('accessoire_annonces.create');
    }

    /**
     * Store a newly created AccessoireAnnonce in storage.
     */
    public function store(CreateAccessoireAnnonceRequest $request)
    {
        $input = $request->all();

        $accessoireAnnonce = $this->accessoireAnnonceRepository->create($input);

        Flash::success('Accessoire Annonce saved successfully.');

        return redirect(route('dash.accessoireAnnonces.index'));
    }

    /**
     * Display the specified AccessoireAnnonce.
     */
    public function show($id)
    {
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            Flash::error('Accessoire Annonce not found');

            return redirect(route('dash.accessoireAnnonces.index'));
        }

        return view('accessoire_annonces.show')->with('accessoireAnnonce', $accessoireAnnonce);
    }

    /**
     * Show the form for editing the specified AccessoireAnnonce.
     */
    public function edit($id)
    {
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            Flash::error('Accessoire Annonce not found');

            return redirect(route('dash.accessoireAnnonces.index'));
        }

        return view('accessoire_annonces.edit')->with('accessoireAnnonce', $accessoireAnnonce);
    }

    /**
     * Update the specified AccessoireAnnonce in storage.
     */
    public function update($id, UpdateAccessoireAnnonceRequest $request)
    {
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            Flash::error('Accessoire Annonce not found');

            return redirect(route('dash.accessoireAnnonces.index'));
        }

        $accessoireAnnonce = $this->accessoireAnnonceRepository->update($request->all(), $id);

        Flash::success('Accessoire Annonce updated successfully.');

        return redirect(route('dash.accessoireAnnonces.index'));
    }

    /**
     * Remove the specified AccessoireAnnonce from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accessoireAnnonce = $this->accessoireAnnonceRepository->find($id);

        if (empty($accessoireAnnonce)) {
            Flash::error('Accessoire Annonce not found');

            return redirect(route('dash.accessoireAnnonces.index'));
        }

        $this->accessoireAnnonceRepository->delete($id);

        Flash::success('Accessoire Annonce deleted successfully.');

        return redirect(route('dash.accessoireAnnonces.index'));
    }
}
