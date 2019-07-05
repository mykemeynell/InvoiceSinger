<?php

namespace InvoiceSinger\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Http\Requests\Concern\RequestHasInvoice;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class InvoiceRequest.
 *
 * @package InvoiceSinger\Http\Requests\Invoice
 */
class InvoiceRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService, RequestHasInvoice;

    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected function getPayloadNamespace(): string
    {
        return 'invoice';
    }
}
