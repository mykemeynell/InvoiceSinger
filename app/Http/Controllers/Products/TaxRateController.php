<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\TaxRateRequest;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Entity\TaxRateEntity;
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
     * Fetch and output products as a JSON object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function fetchAsJson(Request $request): JsonResponse
    {
        /** @var \Illuminate\Database\Eloquent\Collection $tax_rates */
        $tax_rates = $this->getService()->fetch();

        $tax_rates->push(app('product.taxRate.entity')->forceFill([
            'id' => 'none',
            'name' => 'No Tax',
            'multiplier' => 1,
            'amount' => 0
        ]));

        $tax_rates->map(static function(TaxRateEntityInterface $entity) {
            $entity->multiplier = $entity->getMultiplier();
            return $entity;
        });

        if($id = $request->get('id')) {
            return JsonResponse::create($tax_rates->where('id', $id)->first());
        }

        return JsonResponse::create($tax_rates);
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
            ->with('tax_rates', $this->getService()->fetch());
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
            ->with('tax_rate', $request->taxRate());
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

                return RedirectResponse::create(route('products.taxRates'));
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products.taxRates'));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }

    /**
     * Handle a delete request on a tax rate entity.
     *
     * @param \InvoiceSinger\Http\Requests\Product\TaxRateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleDelete(TaxRateRequest $request): RedirectResponse
    {
        try {
            if($unit = $request->taxRate()) {
                $this->getService()->delete($unit);
                return RedirectResponse::create(route('products.taxRates'));
            }

            return abort(404);
        } catch(\Exception $exception) {
            return abort(404, $exception->getMessage());
        }
    }
}
