<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class ProductController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class ProductController extends Controller
{
    use HasService;

    /**
     * ProductController constructor.
     */
    function __construct()
    {
    }

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
     * Show the tax rates view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function taxRates(): View
    {
        return view('products.tax-rates.tax-rates')
            ->with('taxRates', $this->getService('taxRates')->fetch());
    }
}
