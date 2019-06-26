<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;

/**
 * Class UnitController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class UnitController extends Controller
{
    /**
     * Show the unit view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('products.unit');
    }
}
