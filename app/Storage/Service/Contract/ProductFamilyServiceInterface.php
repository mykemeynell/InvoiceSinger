<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface ProductFamilyServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface ProductFamilyServiceInterface extends ServiceInterface
{
    /**
     * Find a product family using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?ProductFamilyEntityInterface;

    /**
     * Return all product families from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Create a new product family entity and store it in the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ProductFamilyEntityInterface;

    /**
     * Update an existing product family entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                          $payload
     *
     * @return bool
     */
    public function update(ProductFamilyEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing product family entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(ProductFamilyEntityInterface $entity): bool;
}
