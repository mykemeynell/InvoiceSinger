<?php

namespace InvoiceSinger\Providers;

use Illuminate\Support\ServiceProvider;
use InvoiceSinger\Support\Concern\Providers\BootOnly;
use InvoiceSinger\View\ViewComposer;

/**
 * Class AppServiceProvider.
 *
 * @package InvoiceSinger\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    use BootOnly;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', ViewComposer::class);
    }
}
