<?php

namespace InvoiceSinger\Http\Controllers\CLients;

use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;

/**
 * Class ClientController.
 *
 * @package InvoiceSinger\Http\Controllers\CLients
 */
class ClientController extends Controller
{
    /**
     * Return clients view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('clients');
    }

    /**
     * Show the clients form view.
     *
     * @return \Illuminate\View\View
     */
    public function form(): View
    {
        return view('clients.form');
    }
}
