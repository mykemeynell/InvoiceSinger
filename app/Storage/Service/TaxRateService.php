<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class TaxRateService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class TaxRateService extends Service implements TaxRateServiceInterface
{
    /**
     * TaxRateService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface $repository
     */
    function __construct(TaxRateRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Fetch all tax rates from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
    }

    /**
     * Attempt to find a tax rate entity in the database using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?TaxRateEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Create a new tax rate entity and store it in the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?TaxRateEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\TaxRateEntity $entity */
        $entity = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $entity->save();

        return $entity;
    }

    /**
     * Update an existing tax rate entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                    $payload
     *
     * @return bool
     */
    public function update(TaxRateEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing tax rate entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(TaxRateEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
