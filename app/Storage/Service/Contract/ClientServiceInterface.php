<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as IlluminateCollection;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface ClientServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface ClientServiceInterface extends ServiceInterface
{
    /**
     * Find a client using a given field. ID by default.
     *
     * @param string $value
     * @param string $match
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $value, $match = 'id'): ?ClientEntityInterface;

    /**
     * Fetch all clients.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Create a new client.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ClientEntityInterface;

    /**
     * Update a client. The $match parameter is used to match an existing entry.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                   $payload
     *
     * @return bool
     */
    public function update(ClientEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing client.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(ClientEntityInterface $entity): bool;

    /**
     * Get the address as an object.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface $entity
     * @param bool                                                         $include_business_name
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAddressObject(ClientEntityInterface $entity, $include_business_name = false): IlluminateCollection;
}
