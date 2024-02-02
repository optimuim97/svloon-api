<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnonceImagesRequest;
use App\Http\Requests\UpdateAnnonceImagesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AnnonceImagesRepository;
use Illuminate\Http\Request;
use Flash;

class AnnonceImagesController extends AppBaseController
{
    /** @var AnnonceImagesRepository $annonceImagesRepository*/
    private $annonceImagesRepository;

    public function __construct(AnnonceImagesRepository $annonceImagesRepo)
    {
        $this->annonceImagesRepository = $annonceImagesRepo;
    }

    /**
     * Display a listing of the AnnonceImages.
     */
    public function index(Request $request)
    {
        return view('annonce_images.index');
    }

    /**
     * Show the form for creating a new AnnonceImages.
     */
    public function create()
    {
        return view('annonce_images.create');
    }

    /**
     * Store a newly created AnnonceImages in storage.
     */
    public function store(CreateAnnonceImagesRequest $request)
    {
        $input = $request->all();

        $annonceImages = $this->annonceImagesRepository->create($input);

        Flash::success('Annonce Images saved successfully.');

        return redirect(route('dash.annonceImages.index'));
    }

    /**
     * Display the specified AnnonceImages.
     */
    public function show($id)
    {
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            Flash::error('Annonce Images not found');

            return redirect(route('dash.annonceImages.index'));
        }

        return view('annonce_images.show')->with('annonceImages', $annonceImages);
    }

    /**
     * Show the form for editing the specified AnnonceImages.
     */
    public function edit($id)
    {
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            Flash::error('Annonce Images not found');

            return redirect(route('dash.annonceImages.index'));
        }

        return view('annonce_images.edit')->with('annonceImages', $annonceImages);
    }

    /**
     * Update the specified AnnonceImages in storage.
     */
    public function update($id, UpdateAnnonceImagesRequest $request)
    {
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            Flash::error('Annonce Images not found');

            return redirect(route('dash.annonceImages.index'));
        }

        $annonceImages = $this->annonceImagesRepository->update($request->all(), $id);

        Flash::success('Annonce Images updated successfully.');

        return redirect(route('dash.annonceImages.index'));
    }

    /**
     * Remove the specified AnnonceImages from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $annonceImages = $this->annonceImagesRepository->find($id);

        if (empty($annonceImages)) {
            Flash::error('Annonce Images not found');

            return redirect(route('dash.annonceImages.index'));
        }

        $this->annonceImagesRepository->delete($id);

        Flash::success('Annonce Images deleted successfully.');

        return redirect(route('dash.annonceImages.index'));
    }
}
