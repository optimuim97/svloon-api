<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistPorfolioRequest;
use App\Http\Requests\UpdateArtistPorfolioRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ArtistPorfolioRepository;
use Illuminate\Http\Request;
use Flash;

class ArtistPorfolioController extends AppBaseController
{
    /** @var ArtistPorfolioRepository $artistPorfolioRepository*/
    private $artistPorfolioRepository;

    public function __construct(ArtistPorfolioRepository $artistPorfolioRepo)
    {
        $this->artistPorfolioRepository = $artistPorfolioRepo;
    }

    /**
     * Display a listing of the ArtistPorfolio.
     */
    public function index(Request $request)
    {
        return view('artist_porfolios.index');
    }

    /**
     * Show the form for creating a new ArtistPorfolio.
     */
    public function create()
    {
        return view('artist_porfolios.create');
    }

    /**
     * Store a newly created ArtistPorfolio in storage.
     */
    public function store(CreateArtistPorfolioRequest $request)
    {
        $input = $request->all();

        $artistPorfolio = $this->artistPorfolioRepository->create($input);

        Flash::success('Artist Porfolio saved successfully.');

        return redirect(route('artistPorfolios.index'));
    }

    /**
     * Display the specified ArtistPorfolio.
     */
    public function show($id)
    {
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            Flash::error('Artist Porfolio not found');

            return redirect(route('artistPorfolios.index'));
        }

        return view('artist_porfolios.show')->with('artistPorfolio', $artistPorfolio);
    }

    /**
     * Show the form for editing the specified ArtistPorfolio.
     */
    public function edit($id)
    {
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            Flash::error('Artist Porfolio not found');

            return redirect(route('artistPorfolios.index'));
        }

        return view('artist_porfolios.edit')->with('artistPorfolio', $artistPorfolio);
    }

    /**
     * Update the specified ArtistPorfolio in storage.
     */
    public function update($id, UpdateArtistPorfolioRequest $request)
    {
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            Flash::error('Artist Porfolio not found');

            return redirect(route('artistPorfolios.index'));
        }

        $artistPorfolio = $this->artistPorfolioRepository->update($request->all(), $id);

        Flash::success('Artist Porfolio updated successfully.');

        return redirect(route('artistPorfolios.index'));
    }

    /**
     * Remove the specified ArtistPorfolio from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $artistPorfolio = $this->artistPorfolioRepository->find($id);

        if (empty($artistPorfolio)) {
            Flash::error('Artist Porfolio not found');

            return redirect(route('artistPorfolios.index'));
        }

        $this->artistPorfolioRepository->delete($id);

        Flash::success('Artist Porfolio deleted successfully.');

        return redirect(route('artistPorfolios.index'));
    }
}
