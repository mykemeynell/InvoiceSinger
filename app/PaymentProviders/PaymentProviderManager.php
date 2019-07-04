<?php

namespace InvoiceSinger\PaymentProviders;

use Exception;
use Illuminate\Support\Collection;

/**
 * Class PaymentProviderManager
 *
 * @package InvoiceSinger\PaymentProviders
 */
class PaymentProviderManager
{
    /**
     * The providers that have been registered within the application.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Get the providers that are registered within the application.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProviders(): Collection
    {
        return collect($this->providers);
    }

    /**
     * Add a new provider to the application.
     *
     * @param $key
     * @param $provider
     *
     * @return void
     *
     * @throws \Exception
     */
    public function addProvider(string $key, PaymentProvider $provider): void
    {
        if($this->getProviders()->has($key)) {
            $provider = $this->getProvider($key);
            throw new Exception("Cannot add provider '{$key}' as it already exists and references '{$provider}'");
        }

        $this->providers[$key] = $provider;
    }

    /**
     * Get a provider from the providers array.
     *
     * @param string $key
     *
     * @return \InvoiceSinger\PaymentProviders\PaymentProvider
     */
    public function getProvider(string $key): PaymentProvider
    {
        return $this->getProviders()->get($key);
    }
}
