<?php

namespace InvoiceSinger\Support\Generators\Invoices;

use InvoiceSinger\Support\Generators\PatternOptions;
use LaravelDatabaseSettings\Service\Contract\SettingServiceInterface;

/**
 * Class InvoiceKeyGenerator
 *
 * @package InvoiceSinger\Support\Generators\Invoices
 */
class InvoiceKeyGenerator
{
    /**
     * The key that has been generated.
     *
     * @var string
     */
    protected $key = '';

    /**
     * InvoiceKeyGenerator constructor.
     *
     * @param \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service
     * @param \InvoiceSinger\Support\Generators\PatternOptions                  $options
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    function __construct(SettingServiceInterface $service, PatternOptions $options)
    {
        $this->key = $service->get('invoice.pattern');

        foreach($options as $placeholder => $value) {
            $this->key = str_replace($placeholder, $value, $this->key);
        }
    }

    /**
     * Get the invoice key generator as a string.
     */
    function __toString(): string
    {
        return $this->key;
    }
}
