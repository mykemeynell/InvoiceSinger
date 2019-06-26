<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductFamilyRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ProductFamilyService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class ProductFamilyService extends Service implements ProductFamilyServiceInterface
{
    /**
     * ProductFamilyService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\ProductFamilyRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(ProductFamilyRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Find a product family using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?ProductFamilyEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Return all product families from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
    }

    /**
     * Create a new product family entity and store it in the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ProductFamilyEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\ProductFamilyEntity $family */
        $family = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $family->save();

        return $family;
    }

    /**
     * Update an existing product family entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                          $payload
     *
     * @return bool
     */
    public function update(ProductFamilyEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing product family entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(ProductFamilyEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
