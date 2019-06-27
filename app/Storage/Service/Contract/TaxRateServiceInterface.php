<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface TaxRateServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface TaxRateServiceInterface extends ServiceInterface
{
    /**
     * Fetch all tax rates from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Attempt to find a tax rate entity in the database using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?TaxRateEntityInterface;

    /**
     * Create a new tax rate entity and store it in the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?TaxRateEntityInterface;

    /**
     * Update an existing tax rate entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                $payload
     *
     * @return bool
     */
    public function update(TaxRateEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing tax rate entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(TaxRateEntityInterface $entity): bool;
}
