<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
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
