<?php

namespace InvoiceSinger\Http\Controllers\Settings;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;

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
     */
    public function index(): View
    {
        return view('settings');
    }
}
