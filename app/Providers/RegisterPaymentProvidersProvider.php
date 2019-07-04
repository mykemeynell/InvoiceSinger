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
     * Register all aliases for this service provider.
     *
     * @return void
     */
    protected $aliases = [

    ];

    /**
     * Bootstrap services.
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $this->prepare();

        /** @var \InvoiceSinger\PaymentProviders\PaymentProviderManager $manager */
        $manager = app('payment.providers.manager');

        foreach(config('payments.providers') as $key => $provider) {
            $manager->addProvider($key, app()->make($provider));
        }
    }

    /**
     * Prepare provider bindings and aliases.
     *
     * @return void
     */
    protected function prepare(): void
    {
        $this->registerAliases();
        $this->app->singleton('payment.providers.manager', PaymentProviderManager::class);
    }
}
