<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ProductFamilyRepositoryInterface;

/**
 * Class ProductFamilyRepository
 *
 * @package InvoiceSinger\Storage\Repository
 */
class ProductFamilyRepository extends Repository implements ProductFamilyRepositoryInterface
{
    /**
     * ProductFamilyRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(ProductFamilyEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
