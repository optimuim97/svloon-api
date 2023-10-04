<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistAddressRequest;
use App\Http\Requests\UpdateArtistAddressRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ArtistAddressRepository;
use Illuminate\Http\Request;
use Flash;

class ArtistAddressController extends AppBaseController
{
    /** @var ArtistAddressRepository $artistAddressRepository*/
    private $artistAddressRepository;

    public function __construct(ArtistAddressRepository $artistAddressRepo)
    {
        $this->artistAddressRepository = $artistAddressRepo;
    }

    /**
     * Display a listing of the ArtistAddress.
     */
    public function index(Request $request)
    {
        return view('artist_addresses.index');
    }

    /**
     * Show the form for creating a new ArtistAddress.
     */
    public function create()
    {
        return view('artist_addresses.create');
    }

    /**
     * Store a newly created ArtistAddress in storage.
     */
    public function store(CreateArtistAddressRequest $request)
    {
        $input = $request->all();

        $artistAddress = $this->artistAddressRepository->create($input);

        Flash::success('Artist Address saved successfully.');

        return redirect(route('artist-addresses.index'));
    }

    /**
     * Display the specified ArtistAddress.
     */
    public function show($id)
    {
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            Flash::error('Artist Address not found');

            return redirect(route('artist-addresses.index'));
        }

        return view('artist_addresses.show')->with('artistAddress', $artistAddress);
    }

    /**
     * Show the form for editing the specified ArtistAddress.
     */
    public function edit($id)
    {
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            Flash::error('Artist Address not found');

            return redirect(route('artist-addresses.index'));
        }

        return view('artist_addresses.edit')->with('artistAddress', $artistAddress);
    }

    /**
     * Update the specified ArtistAddress in storage.
     */
    public function update($id, UpdateArtistAddressRequest $request)
    {
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            Flash::error('Artist Address not found');

            return redirect(route('artist-addresses.index'));
        }

        $artistAddress = $this->artistAddressRepository->update($request->all(), $id);

        Flash::success('Artist Address updated successfully.');

        return redirect(route('artist-addresses.index'));
    }

    /**
     * Remove the specified ArtistAddress from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $artistAddress = $this->artistAddressRepository->find($id);

        if (empty($artistAddress)) {
            Flash::error('Artist Address not found');

            return redirect(route('artist-addresses.index'));
        }

        $this->artistAddressRepository->delete($id);

        Flash::success('Artist Address deleted successfully.');

        return redirect(route('artist-addresses.index'));
    }
}
