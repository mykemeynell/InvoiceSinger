<?php

namespace InvoiceSinger\Http\Controllers\Products;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Product\ProductRequest;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
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
     * Fetch and output products as a JSON object.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function fetchAsJson(): JsonResponse
    {
        /** @var \Illuminate\Database\Eloquent\Collection $products */
        $products = $this->getService()->fetch();

        return JsonResponse::create($products->map(static function (ProductEntityInterface $item) {
            $item->family = collect([$item->family()]);
            $item->unit = collect([$item->unit()]);
            $item->tax_rate = collect([$item->taxRate()]);
            return $item;
        }));
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

                return RedirectResponse::create(route('products'));
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('products'));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }

    /**
     * Handle post request to delete product.
     *
     * @param \InvoiceSinger\Http\Requests\Product\ProductRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleDelete(ProductRequest $request): RedirectResponse
    {
        try {
            $this->getService()->delete($request->product());
            return RedirectResponse::create(route('products'));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
