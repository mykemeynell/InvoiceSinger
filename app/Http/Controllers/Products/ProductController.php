<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\ProductRequest;
use InvoiceSinger\Storage\Service\Contract\ProductServiceInterface;
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
     * @param \InvoiceSinger\Storage\Service\Contract\ProductServiceInterface $service
     */
    function __construct(ProductServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Return the default view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('products')
            ->with('products', $this->getService()->fetch());
    }

    /**
     * Show the product form view.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function form(ProductRequest $request): View
    {
        return view('products.form')
            ->with('product', $request->product());
    }

    /**
     * Handle form post requests for product entities.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(ProductRequest $request): RedirectResponse
    {
        try {
            if ($product = $request->product()) {
                $this->getService()->update($product, $request->getParameterBag());

                return RedirectResponse::create(route('products'), 200);
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products'), 201);
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
