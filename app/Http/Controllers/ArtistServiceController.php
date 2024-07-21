<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistServiceRequest;
use App\Http\Requests\UpdateArtistServiceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ArtistServiceRepository;
use Illuminate\Http\Request;
use Flash;

class ArtistServiceController extends AppBaseController
{
    /** @var ArtistServiceRepository $artistServiceRepository*/
    private $artistServiceRepository;

    public function __construct(ArtistServiceRepository $artistServiceRepo)
    {
        $this->artistServiceRepository = $artistServiceRepo;
    }

    /**
     * Display a listing of the ArtistService.
     */
    public function index(Request $request)
    {
        return view('artist_services.index');
    }

    /**
     * Show the form for creating a new ArtistService.
     */
    public function create()
    {
        return view('artist_services.create');
    }

    /**
     * Store a newly created ArtistService in storage.
     */
    public function store(CreateArtistServiceRequest $request)
    {
        $input = $request->all();

        $artistService = $this->artistServiceRepository->create($input);

        Flash::success('Artist Service saved successfully.');

        return redirect(route('artist-services.index'));
    }

    /**
     * Display the specified ArtistService.
     */
    public function show($id)
    {
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            Flash::error('Artist Service not found');

            return redirect(route('artist-services.index'));
        }

        return view('artist_services.show')->with('artistService', $artistService);
    }

    /**
     * Show the form for editing the specified ArtistService.
     */
    public function edit($id)
    {
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            Flash::error('Artist Service not found');

            return redirect(route('artist-services.index'));
        }

        return view('artist_services.edit')->with('artistService', $artistService);
    }

    /**
     * Update the specified ArtistService in storage.
     */
    public function update($id, UpdateArtistServiceRequest $request)
    {
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            Flash::error('Artist Service not found');

            return redirect(route('artist-services.index'));
        }

        $artistService = $this->artistServiceRepository->update($request->all(), $id);

        Flash::success('Artist Service updated successfully.');

        return redirect(route('artist-services.index'));
    }

    /**
     * Remove the specified ArtistService from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $artistService = $this->artistServiceRepository->find($id);

        if (empty($artistService)) {
            Flash::error('Artist Service not found');

            return redirect(route('artist-services.index'));
        }

        $this->artistServiceRepository->delete($id);

        Flash::success('Artist Service deleted successfully.');

        return redirect(route('artist-services.index'));
    }
}
