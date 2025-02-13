<?php

namespace InvoiceSinger\Requests\Concern;

/**
 * Trait RequestIsAuthorized.
 *
 * @package InvoiceSinger\Requests\Concern
 */
trait RequestIsAuthorized
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
