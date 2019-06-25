<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;
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
     *
     * @param \InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface $taxRateService
     */
    function __construct(TaxRateServiceInterface $taxRateService)
    {
        $this->setService($taxRateService, 'taxRates');
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
     * Return the product tax rates view.
     *
     * @return \Illuminate\View\View
     */
    public function families(): View
    {
        return view('products.families.product-families');
    }

    /**
     * Show the product family form.
     *
     * @return \Illuminate\View\View
     */
    public function familiesForm(): View
    {
        return view('products.families.form');
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
