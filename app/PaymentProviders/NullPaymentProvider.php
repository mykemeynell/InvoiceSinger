<?php

namespace InvoiceSinger\PaymentProviders;

use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;

/**
 * Class NullPaymentProvider
 *
 * @package InvoiceSinger\PaymentProviders
 */
class NullPaymentProvider extends PaymentProvider
{
    /**
     * Handle the creation of a payment instance.
     *
     * @return mixed
     */
    public function handle()
    {
        return null;
    }

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'None';
    }

    /**
     * Get the fields that are required by this provider.
     *
     * Format:
     *  [
     *    'label' => '',
     *    'type' => '',
     *    'name' => '',
     *    'required' => true|false,
     *    'encrypt' => true|false,
     *  ]
     *
     * @return array
     */
    public function getFields(): array
    {
        return [];
    }

    /**
     * Anything that should be added to the frontend, for example:
     *  return "<script>PaymentProvider.addKey(settings('keyname'));</script>";
     *
     * @return string
     */
    public function getFrontendAdditions(): string
    {
        return '';
    }
}
