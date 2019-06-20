<?php

namespace InvoiceSinger\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;

/**
 * Class ClientRequest.
 *
 * @package InvoiceSinger\Http\Requests\Client
 */
class ClientRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag;

    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected function getPayloadNamespace(): string
    {
        return 'client';
    }
}
