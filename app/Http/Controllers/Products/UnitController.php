<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\UnitRequest;
use InvoiceSinger\Storage\Service\Contract\UnitServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class UnitController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class UnitController extends Controller
{
    use HasService;

    /**
     * UnitController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\UnitServiceInterface $service
     */
    function __construct(UnitServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Show the unit view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('products.units.product-units')
            ->with('units', $this->getService()->fetch());
    }

    /**
     * Show the product unit form.
     *
     * @param \InvoiceSinger\Http\Requests\Product\UnitRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function form(UnitRequest $request): View
    {
        return view('products.units.form')
            ->with('unit', $request->unit());
    }

    /**
     * Handle post requests for unit objects.
     *
     * @param \InvoiceSinger\Http\Requests\Product\UnitRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(UnitRequest $request): RedirectResponse
    {
        try {
            if ($unit = $request->unit()) {
                $this->getService()->update($unit, $request->getParameterBag());

                return RedirectResponse::create(route('products.units'));
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products.units'));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }

    /**
     * Handle a delete request on a unit entity.
     *
     * @param \InvoiceSinger\Http\Requests\Product\UnitRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleDelete(UnitRequest $request): RedirectResponse
    {
        try {
            if($unit = $request->unit()) {
                $this->getService()->delete($unit);
                return RedirectResponse::create(route('products.units'));
            }
            return abort(404);
        } catch(\Exception $exception) {
            return abort(404, $exception->getMessage());
        }
    }
}
