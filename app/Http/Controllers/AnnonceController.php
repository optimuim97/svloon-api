<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AnnonceRepository;
use Illuminate\Http\Request;
use Flash;

class AnnonceController extends AppBaseController
{
    /** @var AnnonceRepository $annonceRepository*/
    private $annonceRepository;

    public function __construct(AnnonceRepository $annonceRepo)
    {
        $this->annonceRepository = $annonceRepo;
    }

    /**
     * Display a listing of the Annonce.
     */
    public function index(Request $request)
    {
        return view('annonces.index');
    }

    /**
     * Show the form for creating a new Annonce.
     */
    public function create()
    {
        return view('annonces.create');
    }

    /**
     * Store a newly created Annonce in storage.
     */
    public function store(CreateAnnonceRequest $request)
    {
        $input = $request->all();

        $annonce = $this->annonceRepository->create($input);

        Flash::success('Annonce saved successfully.');

        return redirect(route('dash.annonces.index'));
    }

    /**
     * Display the specified Annonce.
     */
    public function show($id)
    {
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            Flash::error('Annonce not found');

            return redirect(route('dash.annonces.index'));
        }

        return view('annonces.show')->with('annonce', $annonce);
    }

    /**
     * Show the form for editing the specified Annonce.
     */
    public function edit($id)
    {
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            Flash::error('Annonce not found');

            return redirect(route('dash.annonces.index'));
        }

        return view('annonces.edit')->with('annonce', $annonce);
    }

    /**
     * Update the specified Annonce in storage.
     */
    public function update($id, UpdateAnnonceRequest $request)
    {
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            Flash::error('Annonce not found');

            return redirect(route('dash.annonces.index'));
        }

        $annonce = $this->annonceRepository->update($request->all(), $id);

        Flash::success('Annonce updated successfully.');

        return redirect(route('dash.annonces.index'));
    }

    /**
     * Remove the specified Annonce from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $annonce = $this->annonceRepository->find($id);

        if (empty($annonce)) {
            Flash::error('Annonce not found');

            return redirect(route('dash.annonces.index'));
        }

        $this->annonceRepository->delete($id);

        Flash::success('Annonce deleted successfully.');

        return redirect(route('dash.annonces.index'));
    }
}
