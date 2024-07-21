<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnonceCommoditiesRequest;
use App\Http\Requests\UpdateAnnonceCommoditiesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AnnonceCommoditiesRepository;
use Illuminate\Http\Request;
use Flash;

class AnnonceCommoditiesController extends AppBaseController
{
    /** @var AnnonceCommoditiesRepository $annonceCommoditiesRepository*/
    private $annonceCommoditiesRepository;

    public function __construct(AnnonceCommoditiesRepository $annonceCommoditiesRepo)
    {
        $this->annonceCommoditiesRepository = $annonceCommoditiesRepo;
    }

    /**
     * Display a listing of the AnnonceCommodities.
     */
    public function index(Request $request)
    {
        return view('annonce_commodities.index');
    }

    /**
     * Show the form for creating a new AnnonceCommodities.
     */
    public function create()
    {
        return view('annonce_commodities.create');
    }

    /**
     * Store a newly created AnnonceCommodities in storage.
     */
    public function store(CreateAnnonceCommoditiesRequest $request)
    {
        $input = $request->all();

        $annonceCommodities = $this->annonceCommoditiesRepository->create($input);

        Flash::success('Annonce Commodities saved successfully.');

        return redirect(route('dash.annonceCommodities.index'));
    }

    /**
     * Display the specified AnnonceCommodities.
     */
    public function show($id)
    {
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            Flash::error('Annonce Commodities not found');

            return redirect(route('dash.annonceCommodities.index'));
        }

        return view('annonce_commodities.show')->with('annonceCommodities', $annonceCommodities);
    }

    /**
     * Show the form for editing the specified AnnonceCommodities.
     */
    public function edit($id)
    {
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            Flash::error('Annonce Commodities not found');

            return redirect(route('dash.annonceCommodities.index'));
        }

        return view('annonce_commodities.edit')->with('annonceCommodities', $annonceCommodities);
    }

    /**
     * Update the specified AnnonceCommodities in storage.
     */
    public function update($id, UpdateAnnonceCommoditiesRequest $request)
    {
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            Flash::error('Annonce Commodities not found');

            return redirect(route('dash.annonceCommodities.index'));
        }

        $annonceCommodities = $this->annonceCommoditiesRepository->update($request->all(), $id);

        Flash::success('Annonce Commodities updated successfully.');

        return redirect(route('dash.annonceCommodities.index'));
    }

    /**
     * Remove the specified AnnonceCommodities from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $annonceCommodities = $this->annonceCommoditiesRepository->find($id);

        if (empty($annonceCommodities)) {
            Flash::error('Annonce Commodities not found');

            return redirect(route('dash.annonceCommodities.index'));
        }

        $this->annonceCommoditiesRepository->delete($id);

        Flash::success('Annonce Commodities deleted successfully.');

        return redirect(route('dash.annonceCommodities.index'));
    }
}
