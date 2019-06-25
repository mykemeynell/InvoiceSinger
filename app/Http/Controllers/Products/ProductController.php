<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;

/**
 * Class ProductController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class ProductController extends Controller
{
    /**
     * Return the default view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('products');
    }

    /**
     * Return the product tax rates view.
     *
     * @return \Illuminate\View\View
     */
    public function families(): View
    {
        return view('products.families.product-families');
    }

    /**
     * Show the tax rates view.
     *
     * @return \Illuminate\View\View
     */
    public function taxRates(): View
    {
        return view('products.tax-rates.tax-rates');
    }
}
