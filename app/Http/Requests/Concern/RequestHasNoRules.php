<?php

namespace InvoiceSinger\Requests\Concern;

trait RequestHasNoRules
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
