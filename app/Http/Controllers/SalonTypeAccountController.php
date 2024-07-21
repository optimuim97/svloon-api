<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalonTypeAccountRequest;
use App\Http\Requests\UpdateSalonTypeAccountRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalonTypeAccountRepository;
use Illuminate\Http\Request;
use Flash;

class SalonTypeAccountController extends AppBaseController
{
    /** @var SalonTypeAccountRepository $salonTypeAccountRepository*/
    private $salonTypeAccountRepository;

    public function __construct(SalonTypeAccountRepository $salonTypeAccountRepo)
    {
        $this->salonTypeAccountRepository = $salonTypeAccountRepo;
    }

    /**
     * Display a listing of the SalonTypeAccount.
     */
    public function index(Request $request)
    {
        return view('salon_type_accounts.index');
    }

    /**
     * Show the form for creating a new SalonTypeAccount.
     */
    public function create()
    {
        return view('salon_type_accounts.create');
    }

    /**
     * Store a newly created SalonTypeAccount in storage.
     */
    public function store(CreateSalonTypeAccountRequest $request)
    {
        $input = $request->all();

        $salonTypeAccount = $this->salonTypeAccountRepository->create($input);

        Flash::success('Salon Type Account saved successfully.');

        return redirect(route('salon-type-accounts.index'));
    }

    /**
     * Display the specified SalonTypeAccount.
     */
    public function show($id)
    {
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            Flash::error('Salon Type Account not found');

            return redirect(route('salon-type-accounts.index'));
        }

        return view('salon_type_accounts.show')->with('salonTypeAccount', $salonTypeAccount);
    }

    /**
     * Show the form for editing the specified SalonTypeAccount.
     */
    public function edit($id)
    {
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            Flash::error('Salon Type Account not found');

            return redirect(route('salon-type-accounts.index'));
        }

        return view('salon_type_accounts.edit')->with('salonTypeAccount', $salonTypeAccount);
    }

    /**
     * Update the specified SalonTypeAccount in storage.
     */
    public function update($id, UpdateSalonTypeAccountRequest $request)
    {
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            Flash::error('Salon Type Account not found');

            return redirect(route('salon-type-accounts.index'));
        }

        $salonTypeAccount = $this->salonTypeAccountRepository->update($request->all(), $id);

        Flash::success('Salon Type Account updated successfully.');

        return redirect(route('salon-type-accounts.index'));
    }

    /**
     * Remove the specified SalonTypeAccount from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salonTypeAccount = $this->salonTypeAccountRepository->find($id);

        if (empty($salonTypeAccount)) {
            Flash::error('Salon Type Account not found');

            return redirect(route('salon-type-accounts.index'));
        }

        $this->salonTypeAccountRepository->delete($id);

        Flash::success('Salon Type Account deleted successfully.');

        return redirect(route('salon-type-accounts.index'));
    }
}
