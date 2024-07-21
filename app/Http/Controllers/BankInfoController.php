<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBankInfoRequest;
use App\Http\Requests\UpdateBankInfoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BankInfoRepository;
use Illuminate\Http\Request;
use Flash;

class BankInfoController extends AppBaseController
{
    /** @var BankInfoRepository $bankInfoRepository*/
    private $bankInfoRepository;

    public function __construct(BankInfoRepository $bankInfoRepo)
    {
        $this->bankInfoRepository = $bankInfoRepo;
    }

    /**
     * Display a listing of the BankInfo.
     */
    public function index(Request $request)
    {
        return view('bank_infos.index');
    }

    /**
     * Show the form for creating a new BankInfo.
     */
    public function create()
    {
        return view('bank_infos.create');
    }

    /**
     * Store a newly created BankInfo in storage.
     */
    public function store(CreateBankInfoRequest $request)
    {
        $input = $request->all();

        $bankInfo = $this->bankInfoRepository->create($input);

        Flash::success('Bank Info saved successfully.');

        return redirect(route('bank-infos.index'));
    }

    /**
     * Display the specified BankInfo.
     */
    public function show($id)
    {
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            Flash::error('Bank Info not found');

            return redirect(route('bank-infos.index'));
        }

        return view('bank_infos.show')->with('bankInfo', $bankInfo);
    }

    /**
     * Show the form for editing the specified BankInfo.
     */
    public function edit($id)
    {
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            Flash::error('Bank Info not found');

            return redirect(route('bank-infos.index'));
        }

        return view('bank_infos.edit')->with('bankInfo', $bankInfo);
    }

    /**
     * Update the specified BankInfo in storage.
     */
    public function update($id, UpdateBankInfoRequest $request)
    {
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            Flash::error('Bank Info not found');

            return redirect(route('bank-infos.index'));
        }

        $bankInfo = $this->bankInfoRepository->update($request->all(), $id);

        Flash::success('Bank Info updated successfully.');

        return redirect(route('bank-infos.index'));
    }

    /**
     * Remove the specified BankInfo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bankInfo = $this->bankInfoRepository->find($id);

        if (empty($bankInfo)) {
            Flash::error('Bank Info not found');

            return redirect(route('bank-infos.index'));
        }

        $this->bankInfoRepository->delete($id);

        Flash::success('Bank Info deleted successfully.');

        return redirect(route('bank-infos.index'));
    }
}
