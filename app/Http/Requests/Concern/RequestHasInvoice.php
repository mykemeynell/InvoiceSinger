<?php

namespace InvoiceSinger\Http\Requests\Concern;

use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Trait RequestHasInvoice
 *
 * @method ParameterBag getParameterBag() : ParameterBag
 * @method \Illuminate\Routing\Route|object|string route($param = null, $default = null)
 *
 * @package InvoiceSinger\Http\Requests\Concern
 */
trait RequestHasInvoice
{
    /**
     * If an invoice ID is contained within the request, this method will attempt to find and
     * return the associated invoice entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model|null
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
}
