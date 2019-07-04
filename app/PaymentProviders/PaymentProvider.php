<?php

namespace InvoiceSinger\PaymentProviders;

use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;

/**
 * Class PaymentProvider.
 *
 * @package InvoiceSinger\PaymentProviders
 */
abstract class PaymentProvider
{
    /**
     * Handle the creation of a payment instance.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $invoice
     *
     * @return mixed
     */
    abstract public function handle(InvoiceEntityInterface $invoice);

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Anything that should be added to the frontend, for example:
     *  return "<script>PaymentProvider.addKey(settings('keyname'));</script>";
     *
     * @return string
     */
    abstract public function getFrontendAdditions(): string;

    /**
     * Get the fields that are required by this provider.
     *
     * Format:
     *  [
     *    'label' => '',
     *    'type' => '',
     *    'name' => '',
     *    'required' => true|false,
     *    'encrypt' => true|false,
     *  ]
     *
     * @return array
     */
    abstract public function getFields(): array;
}
