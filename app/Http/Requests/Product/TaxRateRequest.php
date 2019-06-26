<?php

namespace InvoiceSinger\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class TaxRateRequest.
 *
 * @package InvoiceSinger\Http\Requests\Product
 */
class TaxRateRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If a product family ID is contained within the request, this method will attempt to find and
     * return the associated product family entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|null
     */
    public function taxRate(): ?TaxRateEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('product.taxRate.service')->find($id);
        }

        if($id = $this->route('tax_rate_id')) {
            return app('product.taxRate.service')->find($id);
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
        return 'taxRate';
    }
}
