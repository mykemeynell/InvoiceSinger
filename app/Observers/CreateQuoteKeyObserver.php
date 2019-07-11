<?php

namespace InvoiceSinger\Observers;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Support\Generators\Quotes\QuoteKeyGenerator;

/**
 * Class CreateQuoteKeyObserver
 *
 * @package InvoiceSinger\Observers
 */
class CreateQuoteKeyObserver
{
    /**
     * Set the model quote key on create.
     *
     * @param Model $model
     *
     * @return void
     * @throws \Exception
     */
    public function creating(Model $model): void
    {
        $model->setAttribute('key', app()->make(QuoteKeyGenerator::class));
        settings()->set('quote.key', settings('quote.key') + 1);
    }
}
