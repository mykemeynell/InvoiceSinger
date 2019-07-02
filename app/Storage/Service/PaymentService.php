<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PaymentService
 *
 * @package InvoiceSinger\Storage\Service
 */
class PaymentService extends Service implements PaymentServiceInterface
{
    /**
     * PaymentService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\PaymentRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(PaymentRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Fetch all payments from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
    }

    /**
     * Find payments using an invoice ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingInvoiceId(string $id): Collection
    {
        return $this->getRepository()->builder()->where('invoice', $id)->get();
    }

    /**
     * Create a new payment entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?PaymentEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\PaymentMethodEntity $payment */
        $payment = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $payment->save();

        return $payment;
    }

    /**
     * Update an existing payment entity in the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                    $payload
     *
     * @return bool
     */
    public function update(PaymentEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete payment entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(PaymentEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
