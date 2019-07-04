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

    /**
     * Get the fields that are required by this povider.
     *
     * @return array
     */
    public function getFields(): array
    {
        return [
            [
                'label' => 'Publishable Key',
                'type' => 'text',
                'name' => 'stripe.publishable_key',
                'required' => true,
                'encrypt' => true,
            ],
            [
                'label' => 'Secret Key',
                'type' => 'text',
                'name' => 'stripe.secret_key',
                'required' => true,
                'encrypt' => true,
            ]
        ];
    }
}
