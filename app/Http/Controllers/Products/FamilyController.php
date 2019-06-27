<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\ProductFamilyRequest;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class FamilyController.
 *
 * @package InvoiceSinger\Http\Controllers\Products
 */
class FamilyController extends Controller
{
    use HasService;

    /**
     * FamilyController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface $service
     */
    function __construct(ProductFamilyServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Return the product tax rates view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('products.families.product-families')
            ->with('families', $this->getService()->fetch());
    }

    /**
     * Show the product family form.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductFamilyRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function form(ProductFamilyRequest $request): View
    {
        return view('products.families.form')
            ->with('family', $request->family());
    }

    /**
     * Handle a post request for a product family.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductFamilyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(ProductFamilyRequest $request): RedirectResponse
    {
        try {
            if ($family = $request->family()) {
                $this->getService()->update($family, $request->getParameterBag());

                return RedirectResponse::create(route('products.families'));
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products.families'));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }

    /**
     * Handle a delete request on a product family entity.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductFamilyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleDelete(ProductFamilyRequest $request): RedirectResponse
    {
        try {
            if($unit = $request->family()) {
                $this->getService()->delete($unit);
                return RedirectResponse::create(route('products.families'));
            }

            return abort(404);
        } catch(\Exception $exception) {
            return abort(404, $exception->getMessage());
        }
    }
}
