<?php

namespace InvoiceSinger\Providers;

use Illuminate\Support\ServiceProvider;
use InvoiceSinger\Providers\Concern\HasAliases;
use InvoiceSinger\Storage\Entity\ClientEntity;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use InvoiceSinger\Storage\Entity\InvoiceEntity;
use InvoiceSinger\Storage\Entity\InvoiceProductEntity;
use InvoiceSinger\Storage\Entity\PaymentEntity;
use InvoiceSinger\Storage\Entity\PaymentMethodEntity;
use InvoiceSinger\Storage\Entity\ProductEntity;
use InvoiceSinger\Storage\Entity\ProductFamilyEntity;
use InvoiceSinger\Storage\Entity\TaxRateEntity;
use InvoiceSinger\Storage\Entity\UnitEntity;
use InvoiceSinger\Storage\Repository\ClientRepository;
use InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceProductRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentMethodRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductFamilyRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductRepositoryInterface;
use InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface;
use InvoiceSinger\Storage\Repository\InvoiceProductRepository;
use InvoiceSinger\Storage\Repository\InvoiceRepository;
use InvoiceSinger\Storage\Repository\PaymentMethodRepository;
use InvoiceSinger\Storage\Repository\PaymentRepository;
use InvoiceSinger\Storage\Repository\ProductFamilyRepository;
use InvoiceSinger\Storage\Repository\ProductRepository;
use InvoiceSinger\Storage\Repository\TaxRateRepository;
use InvoiceSinger\Storage\Service\ClientService;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceProductServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
use InvoiceSinger\Storage\Service\Contract\ProductServiceInterface;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;
use InvoiceSinger\Storage\Service\Contract\UnitServiceInterface;
use InvoiceSinger\Storage\Service\InvoiceProductService;
use InvoiceSinger\Storage\Service\InvoiceService;
use InvoiceSinger\Storage\Service\PaymentMethodService;
use InvoiceSinger\Storage\Service\PaymentService;
use InvoiceSinger\Storage\Service\ProductFamilyService;
use InvoiceSinger\Storage\Service\ProductService;
use InvoiceSinger\Storage\Service\TaxRateService;
use InvoiceSinger\Storage\Service\UnitService;
use InvoiceSinger\Storage\Repository\Contract\UnitRepositoryInterface;
use InvoiceSinger\Storage\Repository\UnitRepository;

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

        'invoice.product.entity' => [InvoiceProductEntityInterface::class],
        'invoice.product.repository' => [InvoiceProductRepositoryInterface::class],
        'invoice.product.service' => [InvoiceProductServiceInterface::class],

        'product.entity'     => [ProductEntityInterface::class],
        'product.repository' => [ProductRepositoryInterface::class],
        'product.service'    => [ProductServiceInterface::class],

        'product.family.entity'     => [ProductFamilyEntityInterface::class],
        'product.family.repository' => [ProductFamilyRepositoryInterface::class],
        'product.family.service'    => [ProductFamilyServiceInterface::class],

        'product.taxRate.entity'     => [TaxRateEntityInterface::class],
        'product.taxRate.repository' => [TaxRateRepositoryInterface::class],
        'product.taxRate.service'    => [TaxRateServiceInterface::class],

        'product.unit.entity' => [UnitEntityInterface::class],
        'product.unit.repository' => [UnitRepositoryInterface::class],
        'product.unit.service' => [UnitServiceInterface::class],

        'payment.method.entity' => [PaymentMethodEntityInterface::class],
        'payment.method.repository' => [PaymentMethodRepositoryInterface::class],
        'payment.method.service' => [PaymentMethodServiceInterface::class],

        'payment.entity' => [PaymentEntityInterface::class],
        'payment.repository' => [PaymentRepositoryInterface::class],
        'payment.service' => [PaymentServiceInterface::class],
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
        $this->app->bind('invoice.product.entity', InvoiceProductEntity::class);
        $this->app->bind('product.entity', ProductEntity::class);
        $this->app->bind('product.family.entity', ProductFamilyEntity::class);
        $this->app->bind('product.taxRate.entity', TaxRateEntity::class);
        $this->app->bind('product.unit.entity', UnitEntity::class);
        $this->app->bind('payment.method.entity', PaymentMethodEntity::class);
        $this->app->bind('payment.entity', PaymentEntity::class);
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
        $this->app->singleton('invoice.product.repository', InvoiceProductRepository::class);
        $this->app->singleton('product.repository', ProductRepository::class);
        $this->app->singleton('product.family.repository', ProductFamilyRepository::class);
        $this->app->singleton('product.taxRate.repository', TaxRateRepository::class);
        $this->app->singleton('product.unit.repository', UnitRepository::class);
        $this->app->singleton('payment.method.repository', PaymentMethodRepository::class);
        $this->app->singleton('payment.repository', PaymentRepository::class);
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
        $this->app->singleton('invoice.product.service', InvoiceProductService::class);
        $this->app->singleton('product.service', ProductService::class);
        $this->app->singleton('product.family.service', ProductFamilyService::class);
        $this->app->singleton('product.taxRate.service', TaxRateService::class);
        $this->app->singleton('product.unit.service', UnitService::class);
        $this->app->singleton('payment.method.service', PaymentMethodService::class);
        $this->app->singleton('payment.service', PaymentService::class);
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
