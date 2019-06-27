<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\ProductServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ProductService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class ProductService extends Service implements ProductServiceInterface
{
    /**
     * ProductService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\ProductRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(ProductRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Fetch a collection of all products in the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
    }

    /**
     * Attempt to find a product entity using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?ProductEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Create a new product entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ProductEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\ProductEntity $product */
        $product = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $product->save();

        return $product;
    }

    /**
     * Update an existing product entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                    $payload
     *
     * @return bool
     */
    public function update(ProductEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing product entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(ProductEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
