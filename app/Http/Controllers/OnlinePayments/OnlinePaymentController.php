<?php

namespace InvoiceSinger\Http\Controllers\OnlinePayments;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;

/**
 * Class OnlinePaymentController
 *
 * @package InvoiceSinger\Http\Controllers
 */
class OnlinePaymentController extends Controller
{
    /**
     * Create a payment request.
     *
     * @param \InvoiceSinger\Http\Requests\Invoice\InvoiceRequest $request
     *
     * @return mixed
     */
    public function handlePost(InvoiceRequest $request)
    {
        /** @var \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager */
        $manager = app('payment.providers.manager');

        /** @var \InvoiceSinger\PaymentProviders\PaymentProvider $payment_provider */
        $payment_provider = $manager->provider(
            settings('app.online_payments.provider')
        );

        if(method_exists($payment_provider, 'boot')) {
            call_user_func_array([$payment_provider, 'boot'], [$request->invoice(), $request]);
        }

        $transaction = $payment_provider->handle();

        if($transaction instanceof RedirectResponse) {
            return $transaction;
        }

        return view('errors.420')
            ->with('end', $payment_provider->getFrontendAdditions());
    }

    /**
     * Show the payment success page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentSuccess(Request $request): View
    {
        dd($request->all());

        return view('online-payments.success');
    }

    /**
     * Show the payment failure page.
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentError(): View
    {
        return view('online-payments.failure');
    }
}
