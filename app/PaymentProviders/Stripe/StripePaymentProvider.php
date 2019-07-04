<?php

namespace InvoiceSinger\PaymentProviders\Stripe;

use InvoiceSinger\PaymentProviders\PaymentProvider;

/**
 * Class StripePaymentProvider.
 *
 * @package InvoiceSinger\PaymentProviders\Stripe
 */
class StripePaymentProvider extends PaymentProvider
{
    /**
     * Handle the creation of a payment instance.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO: Implement handle() method.
    }

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Stripe';
    }
}
