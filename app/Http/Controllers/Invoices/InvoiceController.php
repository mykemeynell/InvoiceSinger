<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;

/**
 * Class InvoiceController
 *
 * @package InvoiceSinger\Http\Controllers\Invoices
 */
class InvoiceController extends Controller
{
    /**
     * Get the list of invoices.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('invoices');
    }
}
