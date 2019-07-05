<?php

namespace InvoiceSinger\Http\Controllers\OnlinePayments;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;
use InvoiceSinger\Http\Requests\Payment\OnlinePaymentWebhookRequest;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class OnlinePaymentController
 *
 * @method PaymentServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers
 */
class OnlinePaymentController extends Controller
{
    use HasService;

    /**
     * OnlinePaymentController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface $service
     *
     */
    function __construct(PaymentServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Create a payment request.
     *
     * @param \InvoiceSinger\Http\Requests\Invoice\InvoiceRequest $request
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function handlePost(InvoiceRequest $request)
    {
        /** @var \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager */
        $manager = app('payment.providers.manager');

        /** @var \InvoiceSinger\PaymentProviders\PaymentProvider $payment_provider */
        $payment_provider = $manager->provider(
            settings('app.online_payments.provider')
        );

        $payment_provider->boot($request->invoice(), $request);
        if (is_null($payment_provider->getPaymentEntity())) {
            throw new \Exception('Payment Provider boot() method must call parent::boot($invoice, $request)');
        }

        $transaction = $payment_provider->handle();
        if ($transaction instanceof RedirectResponse) {
            return $transaction;
        }

        return view('errors.420')
            ->with('end', $payment_provider->getFrontendAdditions());
    }

    /**
     * Handle an incoming webhook - should be called as part of a successful
     * transaction.
     *
     * @param \InvoiceSinger\Http\Requests\Payment\OnlinePaymentWebhookRequest $request
     *
     * @throws \Exception
     */
    public function handleSuccessWebhook(OnlinePaymentWebhookRequest $request)
    {
        $payload = Arr::except(
            $request->getParameterBag()->all(), ['payment_id', 'invoice_id']
        );

        $this->getService()->update($request->payment(), new ParameterBag([
            'payload' => json_encode($payload),
        ]));
    }

    /**
     * Handle an incoming webhook - should be called as part of a failed
     * transaction.
     *
     * @param \InvoiceSinger\Http\Requests\Payment\OnlinePaymentWebhookRequest $request
     *
     * @throws \Exception
     */
    public function handleErrorWebhook(OnlinePaymentWebhookRequest $request): void
    {
        $payload = Arr::except(
            $request->getParameterBag()->all(), ['payment_id', 'invoice_id']
        );

        $this->getService()->update($request->payment(), new ParameterBag([
            'payload' => json_encode($payload),
        ]));
    }

    /**
     * Show the payment success page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function showPaymentSuccess(Request $request): View
    {
        $this->getService()->update(
            $this->getService()->findUsingId($request->get('payment_id')),
            new ParameterBag([
                'committed' => 1,
            ])
        );

        return view('online-payments.success');
    }

    /**
     * Show the payment failure page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function showPaymentError(Request $request): View
    {
        $this->getService()->delete(
            $this->getService()->findUsingId($request->get('payment'))
        );

        return view('online-payments.failure');
    }
}
