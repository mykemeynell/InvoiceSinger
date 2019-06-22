<?php

namespace InvoiceSinger\Observers;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Support\Generators\Invoices\InvoiceKeyGenerator;

/**
 * Class CreateInvoiceObserver
 *
 * @package InvoiceSinger\Observers
 */
class CreateInvoiceKeyObserver
{
    /**
     * Set the model invoice key on create.
     *
     * @param Model $model
     *
     * @return void
     * @throws \Exception
     */
    public function creating(Model $model): void
    {
        $model->setAttribute('key', app()->make(InvoiceKeyGenerator::class));
        settings()->set('invoice.key', settings('invoice.key') + 1);
    }
}
