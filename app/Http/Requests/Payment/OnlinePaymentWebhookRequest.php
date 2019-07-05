<?php

namespace InvoiceSinger\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Http\Requests\Concern\RequestHasInvoice;
use InvoiceSinger\Http\Requests\Concern\RequestHasPayment;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class OnlinePaymentWebhookRequest.
 *
 * @package InvoiceSinger\Http\Requests\Payment
 */
class OnlinePaymentWebhookRequest extends FormRequest
{
    use RequestHasNoRules, RequestIsAuthorized, RequestHasInvoice, RequestHasPayment;

    /**
     * Get the parameter bag.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    public function getParameterBag(): ParameterBag
    {
        return new ParameterBag($this->all());
    }
}
