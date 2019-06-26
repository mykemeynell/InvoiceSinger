<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface UnitServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface UnitServiceInterface extends ServiceInterface
{
    /**
     * Find an existing unit entity using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?UnitEntityInterface;

    /**
     * Fetch all unit entities from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Create a new unit entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?UnitEntityInterface;

    /**
     * Update an existing unit entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag             $payload
     *
     * @return bool
     */
    public function update(UnitEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete a unit from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(UnitEntityInterface $entity): bool;
}
