<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\PaymentMethodRepositoryInterface;

/**
 * Class PaymentMethodRepository
 *
 * @package InvoiceSinger\Storage\Repository
 */
class PaymentMethodRepository extends Repository implements PaymentMethodRepositoryInterface
{
    /**
     * PaymentMethodRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(PaymentMethodEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
