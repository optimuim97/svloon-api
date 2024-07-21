<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ArtistRepository;
use Illuminate\Http\Request;
use Flash;

class ArtistController extends AppBaseController
{
    /** @var ArtistRepository $artistRepository*/
    private $artistRepository;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepository = $artistRepo;
    }

    /**
     * Display a listing of the Artist.
     */
    public function index(Request $request)
    {
        return view('artists.index');
    }

    /**
     * Show the form for creating a new Artist.
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created Artist in storage.
     */
    public function store(CreateArtistRequest $request)
    {
        $input = $request->all();

        $artist = $this->artistRepository->create($input);

        Flash::success('Artist saved successfully.');

        return redirect(route('artists.index'));
    }

    /**
     * Display the specified Artist.
     */
    public function show($id)
    {
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            Flash::error('Artist not found');

            return redirect(route('artists.index'));
        }

        return view('artists.show')->with('artist', $artist);
    }

    /**
     * Show the form for editing the specified Artist.
     */
    public function edit($id)
    {
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            Flash::error('Artist not found');

            return redirect(route('artists.index'));
        }

        return view('artists.edit')->with('artist', $artist);
    }

    /**
     * Update the specified Artist in storage.
     */
    public function update($id, UpdateArtistRequest $request)
    {
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            Flash::error('Artist not found');

            return redirect(route('artists.index'));
        }

        $artist = $this->artistRepository->update($request->all(), $id);

        Flash::success('Artist updated successfully.');

        return redirect(route('artists.index'));
    }

    /**
     * Remove the specified Artist from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $artist = $this->artistRepository->find($id);

        if (empty($artist)) {
            Flash::error('Artist not found');

            return redirect(route('artists.index'));
        }

        $this->artistRepository->delete($id);

        Flash::success('Artist deleted successfully.');

        return redirect(route('artists.index'));
    }
}
