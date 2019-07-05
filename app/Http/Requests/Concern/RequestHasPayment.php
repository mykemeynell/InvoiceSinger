<?php

namespace InvoiceSinger\Http\Requests\Concern;

use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Trait RequestHasInvoice
 *
 * @method ParameterBag getParameterBag() : ParameterBag
 * @method \Illuminate\Routing\Route|object|string route($param = null, $default = null)
 *
 * @package InvoiceSinger\Http\Requests\Concern
 */
trait RequestHasPayment
{
    /**
     * If a payment ID is contained within the request, this method will attempt to find and
     * return the associated payment entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function payment(): ?PaymentEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('payment.service')->findUsingId($id);
        }

        if($id = $this->route('payment_id')) {
            return app('payment.service')->findUsingId($id);
        }

        if($id = $this->get('payment_id')) {
            return app('payment.service')->findUsingId($id);
        }

        return null;
    }
}
