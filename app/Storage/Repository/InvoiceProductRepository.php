<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceProductRepositoryInterface;

/**
 * Class InvoiceProductRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class InvoiceProductRepository extends Repository implements InvoiceProductRepositoryInterface
{
    /**
     * InvoiceProductRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     */
    function __construct(InvoiceProductEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
