<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\ProductFamilyRequest;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
use InvoiceSinger\Storage\Service\ProductFamilyService;
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
     *
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
}
