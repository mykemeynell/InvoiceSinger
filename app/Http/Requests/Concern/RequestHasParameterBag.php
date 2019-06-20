<?php

namespace InvoiceSinger\Requests\Concern;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Trait RequestHasParameterBag.
 *
 * @method string|array|null input($key = null, $default = null)  Retrieve an input item from the request.
 *
 * @package InvoiceSinger\Requests\Concern
 */
trait RequestHasParameterBag
{
    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected abstract function getPayloadNamespace(): string;

    /**
     * Get a parameter bag containing the submitted payload.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    public function getParameterBag(): ParameterBag
    {
        return new ParameterBag($this->input($this->getPayloadNamespace(), []));
    }
}
