<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface ProductServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface ProductServiceInterface extends ServiceInterface
{
    /**
     * Fetch a collection of all products in the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Attempt to find a product entity using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?ProductEntityInterface;

    /**
     * Create a new product entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ProductEntityInterface;

    /**
     * Update an existing product entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                $payload
     *
     * @return bool
     */
    public function update(ProductEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing product entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(ProductEntityInterface $entity): bool;
}
