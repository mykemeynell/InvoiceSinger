<?php

namespace InvoiceSinger\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class ClientRequest.
 *
 * @package InvoiceSinger\Http\Requests\Client
 */
class ClientRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If a client ID is contained within the request, this method will attempt to find and
     * return the associated client entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|null
     */
    public function client(): ?ClientEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            /** @var \InvoiceSinger\Storage\Service\ClientService $service */
            $service = app('client.service');

            return $service->find($id);
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
        return 'client';
    }
}
