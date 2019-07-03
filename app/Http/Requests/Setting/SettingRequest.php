<?php

namespace InvoiceSinger\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use InvoiceSinger\Requests\Concern\RequestHasNoRules;
use InvoiceSinger\Requests\Concern\RequestHasParameterBag;
use InvoiceSinger\Requests\Concern\RequestIsAuthorized;

/**
 * Class SettingRequest
 *
 * @package InvoiceSinger\Http\Requests\Setting
 */
class SettingRequest extends FormRequest
{
    use RequestIsAuthorized, RequestHasParameterBag, RequestHasNoRules;

    /**
     * Get the payload namespace.
     *
     * @return string
     */
    protected function getPayloadNamespace(): string
    {
        return 'settings';
    }
}
