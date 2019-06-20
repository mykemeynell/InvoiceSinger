<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface;

/**
 * Class ClientRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class ClientRepository extends Repository implements ClientRepositoryInterface
{
    /**
     * ClientRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(ClientEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
