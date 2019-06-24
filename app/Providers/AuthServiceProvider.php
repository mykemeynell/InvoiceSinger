<?php

namespace InvoiceSinger\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use InvoiceSinger\Support\Concern\Providers\BootOnly;

/**
 * Class AuthServiceProvider.
 *
 * @package InvoiceSinger\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    use BootOnly;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
