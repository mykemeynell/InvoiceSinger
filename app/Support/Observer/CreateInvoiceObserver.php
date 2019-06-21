<?php

namespace InvoiceSinger\Support\Observer;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Support\Generators\Invoices\InvoiceKeyGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Trait CreateInvoiceObserver
 *
 * @package InvoiceSinger\Support\Observer
 */
trait CreateInvoiceObserver
{
    /**
     * Set the model invoice key on create.
     *
     * @param Model $model
     *
     * @throws \Exception
     */
    public function creating(Model $model): void
    {
        $model->setAttribute('key', app(InvoiceKeyGenerator::class));

        // TODO: Increment invoice.key setting.
    }
}
