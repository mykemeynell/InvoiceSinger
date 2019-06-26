<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\ProductFamilyRequest;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
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
     * @param \InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface       $taxRateService
     * @param \InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface $familyService
     */
    function __construct(TaxRateServiceInterface $taxRateService, ProductFamilyServiceInterface $familyService)
    {
        $this->setService($taxRateService, 'taxRates');
        $this->setService($familyService, 'productFamilies');
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
