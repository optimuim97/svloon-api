<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PaymentTypeRepository;
use Illuminate\Http\Request;
use Flash;

class PaymentTypeController extends AppBaseController
{
    /** @var PaymentTypeRepository $paymentTypeRepository*/
    private $paymentTypeRepository;

    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->paymentTypeRepository = $paymentTypeRepo;
    }

    /**
     * Display a listing of the PaymentType.
     */
    public function index(Request $request)
    {
        return view('payment_types.index');
    }

    /**
     * Show the form for creating a new PaymentType.
     */
    public function create()
    {
        return view('payment_types.create');
    }

    /**
     * Store a newly created PaymentType in storage.
     */
    public function store(CreatePaymentTypeRequest $request)
    {
        $input = $request->all();

        $paymentType = $this->paymentTypeRepository->create($input);

        Flash::success('Payment Type saved successfully.');

        return redirect(route('paymentTypes.index'));
    }

    /**
     * Display the specified PaymentType.
     */
    public function show($id)
    {
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('paymentTypes.index'));
        }

        return view('payment_types.show')->with('paymentType', $paymentType);
    }

    /**
     * Show the form for editing the specified PaymentType.
     */
    public function edit($id)
    {
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('paymentTypes.index'));
        }

        return view('payment_types.edit')->with('paymentType', $paymentType);
    }

    /**
     * Update the specified PaymentType in storage.
     */
    public function update($id, UpdatePaymentTypeRequest $request)
    {
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('paymentTypes.index'));
        }

        $paymentType = $this->paymentTypeRepository->update($request->all(), $id);

        Flash::success('Payment Type updated successfully.');

        return redirect(route('paymentTypes.index'));
    }

    /**
     * Remove the specified PaymentType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paymentType = $this->paymentTypeRepository->find($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('paymentTypes.index'));
        }

        $this->paymentTypeRepository->delete($id);

        Flash::success('Payment Type deleted successfully.');

        return redirect(route('paymentTypes.index'));
    }
}
