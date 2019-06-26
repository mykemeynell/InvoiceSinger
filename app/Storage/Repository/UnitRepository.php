<?php

namespace IssueSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use IssueSinger\Storage\Repository\Contract\UnitRepositoryInterface;

/**
 * Class UnitRepository.
 *
 * @package IssueSinger\Storage\Repository
 */
class UnitRepository extends Repository implements UnitRepositoryInterface
{
    /**
     * UnitRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(UnitEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}