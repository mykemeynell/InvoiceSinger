<?php

namespace InvoiceSinger\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class ProductRequest.
 *
 * @package InvoiceSinger\Http\Requests\Product
 */
class ProductRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If a product ID is contained within the request, this method will attempt to find and
     * return the associated product entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|null
     */
    public function product(): ?ProductEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('product.service')->find($id);
        }

        if($id = $this->route('product_id')) {
            return app('product.service')->find($id);
        }

        return null;
    }

    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected function getPayloadNamespace(): string
    {
        return 'product';
    }
}
