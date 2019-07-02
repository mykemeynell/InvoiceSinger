<?php

namespace InvoiceSinger\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;

/**
 * Class CreatePaymentRequest
 *
 * @package InvoiceSinger\Http\Requests\Payment
 */
class CreatePaymentRequest extends FormRequest
{
    use RequestHasNoRules, RequestHasParameterBag, RequestIsAuthorized;

    /**
     * Retrieve the relevant invoice item for this request.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|null
     */
    public function invoice(): ?InvoiceEntityInterface
    {
        if($id = $this->getParameterBag()->get('invoice_id')) {
            return app('invoice.service')->find($id);
        }

        if($id = $this->route('invoice_id')) {
            return app('invoice.service')->find($id);
        }

        return null;
    }

    /**
     * Retrieve the relevant payment method for this request.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|null
     */
    public function method(): ?PaymentMethodEntityInterface
    {
        if($id = $this->getParameterBag()->get('method')) {
            return app('payment.method.service')->find($id);
        }

        if($id = $this->route('method_id')) {
            return app('payment.method.service')->find($id);
        }

        return null;
    }

    /**
     * Get the referrer route.
     *
     * @return \Illuminate\Routing\Route
     */
    public function referrer(): Route
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()));
    }

    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected function getPayloadNamespace(): string
    {
        return 'payment';
    }
}
