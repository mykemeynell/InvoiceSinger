<?php

namespace InvoiceSinger\Providers;

use Illuminate\Support\ServiceProvider;
use InvoiceSinger\PaymentProviders\PaymentProviderManager;
use InvoiceSinger\Support\Concern\Providers\BootOnly;
use InvoiceSinger\Support\Concern\Providers\RegisterOnly;
use mykemeynell\Support\Providers\Concern\AliasService;

/**
 * Class RegisterPaymentProvidersProvider.
 *
 * @package InvoiceSinger\Providers
 */
class RegisterPaymentProvidersProvider extends ServiceProvider
{
    use BootOnly, AliasService;

    /**
     * Bootstrap services.
     *
     * @param \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager
     *
     * @return void
     *
     * @throws \Exception
     */
    public function boot(PaymentProviderManager $manager)
    {
        foreach(config('payments.providers') as $key => $provider) {
            $manager->addProvider($key, app()->make($provider));
        }

        $this->app->singleton('payment.providers.manager', PaymentProviderManager::class);
    }
}
