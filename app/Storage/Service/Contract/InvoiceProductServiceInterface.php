<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface InvoiceProductInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface InvoiceProductServiceInterface extends ServiceInterface
{
    /**
     * Fetch all products for an invoice ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingInvoiceId(string $id): Collection;

    /**
     * Create a new invoice product.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?InvoiceProductEntityInterface;

    /**
     * Update an existing invoice product entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                           $payload
     *
     * @return bool
     */
    public function update(InvoiceProductEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing invoice product entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface $entity
     *
     * @return bool
     */
    public function delete(InvoiceProductEntityInterface $entity): bool;
}
