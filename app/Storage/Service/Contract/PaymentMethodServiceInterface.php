<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface PaymentMethodServiceInterface
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface PaymentMethodServiceInterface extends ServiceInterface
{
    /**
     * Fetch all payment methods from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Attempt to find an existing payment method form the database.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?PaymentMethodEntityInterface;

    /**
     * Create a new payment method and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?PaymentMethodEntityInterface;

    /**
     * Update an existing payment method and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                          $payload
     *
     * @return bool
     */
    public function update(PaymentMethodEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing payment method from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(PaymentMethodEntityInterface $entity): bool;
}
