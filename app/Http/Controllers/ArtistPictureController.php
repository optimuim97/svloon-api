<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistPictureRequest;
use App\Http\Requests\UpdateArtistPictureRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ArtistPictureRepository;
use Illuminate\Http\Request;
use Flash;

class ArtistPictureController extends AppBaseController
{
    /** @var ArtistPictureRepository $artistPictureRepository*/
    private $artistPictureRepository;

    public function __construct(ArtistPictureRepository $artistPictureRepo)
    {
        $this->artistPictureRepository = $artistPictureRepo;
    }

    /**
     * Display a listing of the ArtistPicture.
     */
    public function index(Request $request)
    {
        return view('artist_pictures.index');
    }

    /**
     * Show the form for creating a new ArtistPicture.
     */
    public function create()
    {
        return view('artist_pictures.create');
    }

    /**
     * Store a newly created ArtistPicture in storage.
     */
    public function store(CreateArtistPictureRequest $request)
    {
        $input = $request->all();

        $artistPicture = $this->artistPictureRepository->create($input);

        Flash::success('Artist Picture saved successfully.');

        return redirect(route('artist-pictures.index'));
    }

    /**
     * Display the specified ArtistPicture.
     */
    public function show($id)
    {
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            Flash::error('Artist Picture not found');

            return redirect(route('artist-pictures.index'));
        }

        return view('artist_pictures.show')->with('artistPicture', $artistPicture);
    }

    /**
     * Show the form for editing the specified ArtistPicture.
     */
    public function edit($id)
    {
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            Flash::error('Artist Picture not found');

            return redirect(route('artist-pictures.index'));
        }

        return view('artist_pictures.edit')->with('artistPicture', $artistPicture);
    }

    /**
     * Update the specified ArtistPicture in storage.
     */
    public function update($id, UpdateArtistPictureRequest $request)
    {
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            Flash::error('Artist Picture not found');

            return redirect(route('artist-pictures.index'));
        }

        $artistPicture = $this->artistPictureRepository->update($request->all(), $id);

        Flash::success('Artist Picture updated successfully.');

        return redirect(route('artist-pictures.index'));
    }

    /**
     * Remove the specified ArtistPicture from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $artistPicture = $this->artistPictureRepository->find($id);

        if (empty($artistPicture)) {
            Flash::error('Artist Picture not found');

            return redirect(route('artist-pictures.index'));
        }

        $this->artistPictureRepository->delete($id);

        Flash::success('Artist Picture deleted successfully.');

        return redirect(route('artist-pictures.index'));
    }
}
