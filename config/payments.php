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

        // The NullPaymentProvider is used as the "None" provider option.
        // Technically it isn't required, but nice to have an option to disable
        // online payments if you dont want online payment as an option to your
        // customers.
        'none' => InvoiceSinger\PaymentProviders\NullPaymentProvider::class,

        'stripe' => InvoiceSinger\PaymentProviders\Stripe\StripePaymentProvider::class,
    ],

];
