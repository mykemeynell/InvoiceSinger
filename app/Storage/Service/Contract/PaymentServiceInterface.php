<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface PaymentServiceInterface
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface PaymentServiceInterface extends ServiceInterface
{
    /**
     * Fetch all payments from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Find payments using an invoice ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingInvoiceId(string $id): Collection;

    /**
     * Find a single payment using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingId(string $id): ?PaymentEntityInterface;

    /**
     * Create a new payment entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?PaymentEntityInterface;

    /**
     * Update an existing payment entity in the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                    $payload
     *
     * @return bool
     */
    public function update(PaymentEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete payment entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(PaymentEntityInterface $entity): bool;
}
