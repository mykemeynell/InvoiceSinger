<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductRepositoryInterface;

/**
 * Class ProductRepositoryInterface.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class ProductRepository extends Repository implements ProductRepositoryInterface
{
    /**
     * ProductRepositoryInterface constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(ProductEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
