<?php

namespace InvoiceSinger\Observers;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Support\Generators\Invoices\InvoiceKeyGenerator;

/**
 * Class CreateInvoiceObserver
 *
 * @package InvoiceSinger\Observers
 */
class CreateInvoiceObserver
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
    }
}
