<?php

/**
 * Get the currency.
 *
 * @return string
 */
function currency(): string
{
    return settings('app.currency');
}

/**
 * Get the currency entity.
 *
 * @return string
 *
 * @throws \Illuminate\Contracts\Container\BindingResolutionException
 */
function currencyEntity(): string
{
    /** @var \mykemeynell\Support\CurrencyHtmlEntities $che */
    $che = app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class);

    return $che->entity(currency());
}
