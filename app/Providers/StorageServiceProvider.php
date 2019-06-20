<?php

namespace InvoiceSinger\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use InvoiceSinger\Providers\Concern\HasAliases;
use InvoiceSinger\Storage\Entity\ClientEntity;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\InvoiceEntity;
use InvoiceSinger\Storage\Repository\ClientRepository;
use InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceRepositoryInterface;
use InvoiceSinger\Storage\Repository\InvoiceRepository;
use InvoiceSinger\Storage\Service\ClientService;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Storage\Service\InvoiceService;

/**
 * Class StorageServiceProvider.
 *
 * @package InvoiceSinger\Providers
 */
class StorageServiceProvider extends ServiceProvider
{
    use HasAliases;

    /**
     * The services aliases, we need to update the provides array too.
     *
     * @var array
     */
    protected $aliases = [
        'client.entity'     => [ClientEntityInterface::class],
        'client.repository' => [ClientRepositoryInterface::class],
        'client.service'    => [ClientServiceInterface::class],

        'invoice.entity'     => [InvoiceEntityInterface::class],
        'invoice.repository' => [InvoiceRepositoryInterface::class],
        'invoice.service'    => [InvoiceServiceInterface::class],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();
        $this->registerEntities();
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Register entities within the application.
     *
     * @return void
     */
    public function registerEntities(): void
    {
        $this->app->bind('client.entity', ClientEntity::class);
        $this->app->bind('invoice.entity', InvoiceEntity::class);
    }

    /**
     * Register repositories within the application.
     *
     * @return void
     */
    public function registerRepositories(): void
    {
        $this->app->singleton('client.repository', ClientRepository::class);
        $this->app->singleton('invoice.repository', InvoiceRepository::class);
    }

    /**
     * Register services within the application.
     *
     * @return void
     */
    public function registerServices(): void
    {
        $this->app->singleton('client.service', ClientService::class);
        $this->app->singleton('invoice.service', InvoiceService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        $provides = [];

        foreach ($this->aliases as $alias => $providers) {
            $provides[] = $alias;
            foreach ($providers as $provider) {
                $provides[] = $provider;
            }
        }

        return $provides;
    }
}
