<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\QuoteRepositoryInterface;

/**
 * Class QuoteRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class QuoteRepository extends Repository implements QuoteRepositoryInterface
{
    /**
     * QuoteRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     */
    function __construct(QuoteEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
