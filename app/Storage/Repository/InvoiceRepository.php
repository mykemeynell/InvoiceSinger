<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceRepositoryInterface;

/**
 * Class InvoiceRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class InvoiceRepository extends Repository implements InvoiceRepositoryInterface
{
    /**
     * InvoiceRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(InvoiceEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
