<?php

namespace InvoiceSinger\Http\Controllers\Settings;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use mykemeynell\Support\CurrencyHtmlEntities;

/**
 * Class SettingController
 *
 * @package InvoiceSinger\Http\Controllers\Settings
 */
class SettingController extends Controller
{
    /**
     * Get the settings view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        return view('settings')
            ->with('app_currency', settings('app.currency'))
            ->with('app_currency_options', app()->make(CurrencyHtmlEntities::class)->all());
    }
}
