<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
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
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     * @param string                                         $match
     *
     * @return bool
     */
    public function update(ParameterBag $payload, $match = 'id'): bool;

    /**
     * Delete an existing client.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(ClientEntityInterface $entity): bool;
}
