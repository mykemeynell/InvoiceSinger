<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\TaxRateRequest;
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

    /**
     * Show the tax rates form.
     *
     * @param \InvoiceSinger\Http\Requests\Product\TaxRateRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function form(TaxRateRequest $request): View
    {
        return view('products.tax-rates.form')
            ->with('taxRate', $request->taxRate());
    }

    /**
     * Handle a post request for a tax rate.
     *
     * @param \InvoiceSinger\Http\Requests\Product\TaxRateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(TaxRateRequest $request): RedirectResponse
    {
        try {
            if ($tax_rate = $request->taxRate()) {
                $this->getService()->update($tax_rate, $request->getParameterBag());

                return RedirectResponse::create(route('products.taxRates'), 200);
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products.taxRates'), 201);
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
