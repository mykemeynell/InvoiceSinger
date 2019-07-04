<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Providers
    |--------------------------------------------------------------------------
    |
    | The payment providers that can be used in the application. These should
    | be fully qualified namespaces, and be instantiable objects.
    |
    | Payment providers are indexed by their key, so you should make sure
    | that when adding new providers, that the key you pick isn't already used
    | by another provider.
    |
    | Format:
    |     'stripe' => Fully\Qualified\Namespace\ProviderClass::class,
    |
    */

    'providers' => [
        'stripe' => InvoiceSinger\PaymentProviders\Stripe\StripePaymentProvider::class,
    ],

];
