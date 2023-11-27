<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceArtistRequest;
use App\Http\Requests\UpdateServiceArtistRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ServiceArtistRepository;
use Illuminate\Http\Request;
use Flash;

class ServiceArtistController extends AppBaseController
{
    /** @var ServiceArtistRepository $serviceArtistRepository*/
    private $serviceArtistRepository;

    public function __construct(ServiceArtistRepository $serviceArtistRepo)
    {
        $this->serviceArtistRepository = $serviceArtistRepo;
    }

    /**
     * Display a listing of the ServiceArtist.
     */
    public function index(Request $request)
    {
        return view('service_artists.index');
    }

    /**
     * Show the form for creating a new ServiceArtist.
     */
    public function create()
    {
        return view('service_artists.create');
    }

    /**
     * Store a newly created ServiceArtist in storage.
     */
    public function store(CreateServiceArtistRequest $request)
    {
        $input = $request->all();

        $serviceArtist = $this->serviceArtistRepository->create($input);

        Flash::success('Service Artist saved successfully.');

        return redirect(route('serviceArtists.index'));
    }

    /**
     * Display the specified ServiceArtist.
     */
    public function show($id)
    {
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            Flash::error('Service Artist not found');

            return redirect(route('serviceArtists.index'));
        }

        return view('service_artists.show')->with('serviceArtist', $serviceArtist);
    }

    /**
     * Show the form for editing the specified ServiceArtist.
     */
    public function edit($id)
    {
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            Flash::error('Service Artist not found');

            return redirect(route('serviceArtists.index'));
        }

        return view('service_artists.edit')->with('serviceArtist', $serviceArtist);
    }

    /**
     * Update the specified ServiceArtist in storage.
     */
    public function update($id, UpdateServiceArtistRequest $request)
    {
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            Flash::error('Service Artist not found');

            return redirect(route('serviceArtists.index'));
        }

        $serviceArtist = $this->serviceArtistRepository->update($request->all(), $id);

        Flash::success('Service Artist updated successfully.');

        return redirect(route('serviceArtists.index'));
    }

    /**
     * Remove the specified ServiceArtist from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $serviceArtist = $this->serviceArtistRepository->find($id);

        if (empty($serviceArtist)) {
            Flash::error('Service Artist not found');

            return redirect(route('serviceArtists.index'));
        }

        $this->serviceArtistRepository->delete($id);

        Flash::success('Service Artist deleted successfully.');

        return redirect(route('serviceArtists.index'));
    }
}
