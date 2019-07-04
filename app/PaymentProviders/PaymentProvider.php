<?php

namespace InvoiceSinger\PaymentProviders;

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
     * @return mixed
     */
    abstract public function handle();

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    abstract public function getName(): string;
}
