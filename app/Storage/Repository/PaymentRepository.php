<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentRepositoryInterface;

/**
 * Class PaymentRepository
 *
 * @package InvoiceSinger\Storage\Repository
 */
class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    /**
     * PaymentRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(PaymentEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
