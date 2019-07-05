<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentMethodRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PaymentMethodService
 *
 * @package InvoiceSinger\Storage\Service
 */
class PaymentMethodService extends Service implements PaymentMethodServiceInterface
{
    /**
     * PaymentMethodService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\PaymentMethodRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(PaymentMethodRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Attempt to find a payment method using its slug.
     *
     * @param string $slug
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingSlug(string $slug): ?PaymentMethodEntityInterface
    {
        return $this->getRepository()->builder()->where('slug', $slug)->first();
    }

    /**
     * Fetch all payment methods from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
    }

    /**
     * Attempt to find an existing payment method form the database.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?PaymentMethodEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Create a new payment method and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?PaymentMethodEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\PaymentMethodEntity $method */
        $method = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $method->save();

        return $method;
    }

    /**
     * Update an existing payment method and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                          $payload
     *
     * @return bool
     */
    public function update(PaymentMethodEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing payment method from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(PaymentMethodEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
