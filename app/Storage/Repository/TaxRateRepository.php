<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface;

/**
 * Class TaxRateRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class TaxRateRepository extends Repository implements TaxRateRepositoryInterface
{
    /**
     * TaxRateRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(TaxRateEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
