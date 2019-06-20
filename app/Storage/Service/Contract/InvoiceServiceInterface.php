<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface InvoiceServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface InvoiceServiceInterface extends ServiceInterface
{
    /**
     * Find a client using a given field. ID by default.
     *
     * @param string $value
     * @param string $match
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $value, $match = 'id'): ?InvoiceEntityInterface;

    /**
     * Fetch all invoices.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Create a new invoice item.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface
     */
    public function create(ParameterBag $payload): InvoiceEntityInterface;

    /**
     * Update an existing invoice item.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                $payload
     *
     * @return bool
     */
    public function update(InvoiceEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing invoice item.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(InvoiceEntityInterface $entity): bool;
}
