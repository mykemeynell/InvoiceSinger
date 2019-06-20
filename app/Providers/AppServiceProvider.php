<?php

namespace InvoiceSinger\Providers;

use Illuminate\Support\ServiceProvider;
use InvoiceSinger\View\ViewComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

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
