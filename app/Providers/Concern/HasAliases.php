<?php

namespace InvoiceSinger\Providers\Concern;

/**
 * Trait HasAliases.
 *
 * @property array $aliases
 * @property \Illuminate\Foundation\Application $app
 *
 * @package InvoiceSinger\Providers\Concern
 */
trait HasAliases
{
    /**
     * Register all aliases for this service provider.
     *
     * @return void
     */
    public function registerAliases(): void
    {
        foreach((array) $this->aliases as $key => $aliases) {
            foreach($aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }
}
