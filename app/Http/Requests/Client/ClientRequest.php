<?php

namespace InvoiceSinger\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;

/**
 * Class ClientRequest.
 *
 * @package InvoiceSinger\Http\Requests\Client
 */
class ClientRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag;

    public function client(): ?ClientEntityInterface
    {
        // TODO: Implement client() method.
        // If a client ID is passed then client() should return a ClientEntityInterface of that object.
    }

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
