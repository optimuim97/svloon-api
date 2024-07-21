<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarteRequest;
use App\Http\Requests\UpdateCarteRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CarteRepository;
use Illuminate\Http\Request;
use Flash;

class CarteController extends AppBaseController
{
    /** @var CarteRepository $carteRepository*/
    private $carteRepository;

    public function __construct(CarteRepository $carteRepo)
    {
        $this->carteRepository = $carteRepo;
    }

    /**
     * Display a listing of the Carte.
     */
    public function index(Request $request)
    {
        return view('cartes.index');
    }

    /**
     * Show the form for creating a new Carte.
     */
    public function create()
    {
        return view('cartes.create');
    }

    /**
     * Store a newly created Carte in storage.
     */
    public function store(CreateCarteRequest $request)
    {
        $input = $request->all();

        $carte = $this->carteRepository->create($input);

        Flash::success('Carte saved successfully.');

        return redirect(route('cartes.index'));
    }

    /**
     * Display the specified Carte.
     */
    public function show($id)
    {
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            Flash::error('Carte not found');

            return redirect(route('cartes.index'));
        }

        return view('cartes.show')->with('carte', $carte);
    }

    /**
     * Show the form for editing the specified Carte.
     */
    public function edit($id)
    {
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            Flash::error('Carte not found');

            return redirect(route('cartes.index'));
        }

        return view('cartes.edit')->with('carte', $carte);
    }

    /**
     * Update the specified Carte in storage.
     */
    public function update($id, UpdateCarteRequest $request)
    {
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            Flash::error('Carte not found');

            return redirect(route('cartes.index'));
        }

        $carte = $this->carteRepository->update($request->all(), $id);

        Flash::success('Carte updated successfully.');

        return redirect(route('cartes.index'));
    }

    /**
     * Remove the specified Carte from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $carte = $this->carteRepository->find($id);

        if (empty($carte)) {
            Flash::error('Carte not found');

            return redirect(route('cartes.index'));
        }

        $this->carteRepository->delete($id);

        Flash::success('Carte deleted successfully.');

        return redirect(route('cartes.index'));
    }
}
