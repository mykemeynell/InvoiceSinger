<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class TaxRateController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class TaxRateController extends Controller
{
    use HasService;

    /**
     * TaxRateController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface $service
     *
     */
    function __construct(TaxRateServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Get the list view of existing tax rates.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('products.tax-rates.tax-rates')
            ->with('taxRates', $this->getService()->fetch());
    }
}
