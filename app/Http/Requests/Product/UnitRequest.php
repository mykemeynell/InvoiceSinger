<?php

namespace InvoiceSinger\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class UnitRequest
 *
 * @package InvoiceSinger\Http\Requests\Product
 */
class UnitRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If a unit ID is contained within the request, this method will attempt to find and
     * return the associated unit entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|null
     */
    public function unit(): ?UnitEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('product.unit.service')->find($id);
        }

        if($id = $this->route('unit_id')) {
            return app('product.unit.service')->find($id);
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
        return 'unit';
    }
}
