<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonPictureRequest;
use App\Http\Requests\UpdateSalonPictureRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonPictureRepository;
use Illuminate\Http\Request;
use Flash;

class SalonPictureController extends AppBaseController
{
    /** @var SalonPictureRepository $salonPictureRepository*/
    private $salonPictureRepository;

    public function __construct(SalonPictureRepository $salonPictureRepo)
    {
        $this->salonPictureRepository = $salonPictureRepo;
    }

    /**
     * Display a listing of the SalonPicture.
     */
    public function index(Request $request)
    {
        return view('salon_pictures.index');
    }

    /**
     * Show the form for creating a new SalonPicture.
     */
    public function create()
    {
        return view('salon_pictures.create');
    }

    /**
     * Store a newly created SalonPicture in storage.
     */
    public function store(CreateSalonPictureRequest $request)
    {
        $input = $request->all();

        $salonPicture = $this->salonPictureRepository->create($input);

        Flash::success('Salon Picture saved successfully.');

        return redirect(route('salon-pictures.index'));
    }

    /**
     * Display the specified SalonPicture.
     */
    public function show($id)
    {
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            Flash::error('Salon Picture not found');

            return redirect(route('salon-pictures.index'));
        }

        return view('salon_pictures.show')->with('salonPicture', $salonPicture);
    }

    /**
     * Show the form for editing the specified SalonPicture.
     */
    public function edit($id)
    {
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            Flash::error('Salon Picture not found');

            return redirect(route('salon-pictures.index'));
        }

        return view('salon_pictures.edit')->with('salonPicture', $salonPicture);
    }

    /**
     * Update the specified SalonPicture in storage.
     */
    public function update($id, UpdateSalonPictureRequest $request)
    {
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            Flash::error('Salon Picture not found');

            return redirect(route('salon-pictures.index'));
        }

        $salonPicture = $this->salonPictureRepository->update($request->all(), $id);

        Flash::success('Salon Picture updated successfully.');

        return redirect(route('salon-pictures.index'));
    }

    /**
     * Remove the specified SalonPicture from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonPicture = $this->salonPictureRepository->find($id);

        if (empty($salonPicture)) {
            Flash::error('Salon Picture not found');

            return redirect(route('salon-pictures.index'));
        }

        $this->salonPictureRepository->delete($id);

        Flash::success('Salon Picture deleted successfully.');

        return redirect(route('salon-pictures.index'));
    }
}
