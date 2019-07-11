<?php

namespace InvoiceSinger\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class QuoteRequest.
 *
 * @package InvoiceSinger\Http\Requests\Quote
 */
class QuoteRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasNoRules, RequestHasParameterBag, HasService;

    /**
     * If an quote ID is contained within the request, this method will attempt to find and
     * return the associated quote entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function quote(): ?QuoteEntityInterface
    {
        if($id = $this->getParameterBag()->get('id')) {
            return app('quote.service')->findUsingId($id);
        }

        if($id = $this->route('quote_id')) {
            return app('quote.service')->findUsingId($id);
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
        return 'quote';
    }
}
