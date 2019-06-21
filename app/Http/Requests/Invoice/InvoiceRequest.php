<?php

namespace InvoiceSinger\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class InvoiceRequest.
 *
 * @package InvoiceSinger\Http\Requests\Invoice
 */
class InvoiceRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If an invoice ID is contained within the request, this method will attempt to find and
     * return the associated invoice entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|null
     */
    public function invoice(): ?InvoiceEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('invoice.service')->find($id);
        }

        if($id = $this->route('invoice_id')) {
            return app('invoice.service')->find($id);
        }

        return null;
    }

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
