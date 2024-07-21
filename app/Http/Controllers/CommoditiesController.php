<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommoditiesRequest;
use App\Http\Requests\UpdateCommoditiesRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Commodities;
use App\Repositories\CommoditiesRepository;
use Illuminate\Http\Request;
use Flash;

class CommoditiesController extends AppBaseController
{
    /** @var CommoditiesRepository $commoditiesRepository*/
    private $commoditiesRepository;

    public function __construct(CommoditiesRepository $commoditiesRepo)
    {
        $this->commoditiesRepository = $commoditiesRepo;
    }

    /**
     * Display a listing of the Commodities.
     */
    public function index(Request $request)
    {
        return view('commodities.index');
    }

    /**
     * Show the form for creating a new Commodities.
     */
    public function create()
    {
        return view('commodities.create');
    }

    /**
     * Store a newly created Commodities in storage.
     */
    public function store(CreateCommoditiesRequest $request)
    {
        $input = $request->all();

        if (!empty($input['imageUrl'])) {
            $url = (new Commodities())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        }

        $commodities = $this->commoditiesRepository->create($input);

        Flash::success('Commodities saved successfully.');

        return redirect(route('commodities.index'));
    }

    /**
     * Display the specified Commodities.
     */
    public function show($id)
    {
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            Flash::error('Commodities not found');

            return redirect(route('commodities.index'));
        }

        return view('commodities.show')->with('commodities', $commodities);
    }

    /**
     * Show the form for editing the specified Commodities.
     */
    public function edit($id)
    {
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            Flash::error('Commodities not found');

            return redirect(route('commodities.index'));
        }

        return view('commodities.edit')->with('commodities', $commodities);
    }

    /**
     * Update the specified Commodities in storage.
     */
    public function update($id, UpdateCommoditiesRequest $request)
    {
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            Flash::error('Commodities not found');

            return redirect(route('commodities.index'));
        }

        if (!empty($input['imageUrl'])) {
            $url = (new Commodities())->upload($request, 'imageUrl');
            $input['imageUrl'] = $url;
        } else {
            $input['imageUrl'] = $commodities->imageUrl;
        }

        $commodities = $this->commoditiesRepository->update($request->all(), $id);

        Flash::success('Commodities updated successfully.');

        return redirect(route('commodities.index'));
    }

    /**
     * Remove the specified Commodities from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $commodities = $this->commoditiesRepository->find($id);

        if (empty($commodities)) {
            Flash::error('Commodities not found');

            return redirect(route('commodities.index'));
        }

        $this->commoditiesRepository->delete($id);

        Flash::success('Commodities deleted successfully.');

        return redirect(route('commodities.index'));
    }
}
