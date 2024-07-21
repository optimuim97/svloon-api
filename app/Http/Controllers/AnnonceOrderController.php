<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnonceOrderRequest;
use App\Http\Requests\UpdateAnnonceOrderRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AnnonceOrderRepository;
use Illuminate\Http\Request;
use Flash;

class AnnonceOrderController extends AppBaseController
{
    /** @var AnnonceOrderRepository $annonceOrderRepository*/
    private $annonceOrderRepository;

    public function __construct(AnnonceOrderRepository $annonceOrderRepo)
    {
        $this->annonceOrderRepository = $annonceOrderRepo;
    }

    /**
     * Display a listing of the AnnonceOrder.
     */
    public function index(Request $request)
    {
        return view('annonce_orders.index');
    }

    /**
     * Show the form for creating a new AnnonceOrder.
     */
    public function create()
    {
        return view('annonce_orders.create');
    }

    /**
     * Store a newly created AnnonceOrder in storage.
     */
    public function store(CreateAnnonceOrderRequest $request)
    {
        $input = $request->all();

        $annonceOrder = $this->annonceOrderRepository->create($input);

        Flash::success('Annonce Order saved successfully.');

        return redirect(route('dash.annonceOrders.index'));
    }

    /**
     * Display the specified AnnonceOrder.
     */
    public function show($id)
    {
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            Flash::error('Annonce Order not found');

            return redirect(route('dash.annonceOrders.index'));
        }

        return view('annonce_orders.show')->with('annonceOrder', $annonceOrder);
    }

    /**
     * Show the form for editing the specified AnnonceOrder.
     */
    public function edit($id)
    {
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            Flash::error('Annonce Order not found');

            return redirect(route('dash.annonceOrders.index'));
        }

        return view('annonce_orders.edit')->with('annonceOrder', $annonceOrder);
    }

    /**
     * Update the specified AnnonceOrder in storage.
     */
    public function update($id, UpdateAnnonceOrderRequest $request)
    {
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            Flash::error('Annonce Order not found');

            return redirect(route('dash.annonceOrders.index'));
        }

        $annonceOrder = $this->annonceOrderRepository->update($request->all(), $id);

        Flash::success('Annonce Order updated successfully.');

        return redirect(route('dash.annonceOrders.index'));
    }

    /**
     * Remove the specified AnnonceOrder from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $annonceOrder = $this->annonceOrderRepository->find($id);

        if (empty($annonceOrder)) {
            Flash::error('Annonce Order not found');

            return redirect(route('dash.annonceOrders.index'));
        }

        $this->annonceOrderRepository->delete($id);

        Flash::success('Annonce Order deleted successfully.');

        return redirect(route('dash.annonceOrders.index'));
    }
}
