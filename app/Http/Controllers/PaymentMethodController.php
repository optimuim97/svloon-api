<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Http\Request;
use Flash;

class PaymentMethodController extends AppBaseController
{
    /** @var PaymentMethodRepository $paymentMethodRepository*/
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentMethodRepository = $paymentMethodRepo;
    }

    /**
     * Display a listing of the PaymentMethod.
     */
    public function index(Request $request)
    {
        return view('payment_methods.index');
    }

    /**
     * Show the form for creating a new PaymentMethod.
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created PaymentMethod in storage.
     */
    public function store(CreatePaymentMethodRequest $request)
    {
        $input = $request->all();

        $paymentMethod = $this->paymentMethodRepository->create($input);

        Flash::success('Payment Method saved successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Display the specified PaymentMethod.
     */
    public function show($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.show')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Show the form for editing the specified PaymentMethod.
     */
    public function edit($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.edit')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Update the specified PaymentMethod in storage.
     */
    public function update($id, UpdatePaymentMethodRequest $request)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        $paymentMethod = $this->paymentMethodRepository->update($request->all(), $id);

        Flash::success('Payment Method updated successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Remove the specified PaymentMethod from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        $this->paymentMethodRepository->delete($id);

        Flash::success('Payment Method deleted successfully.');

        return redirect(route('paymentMethods.index'));
    }
}
