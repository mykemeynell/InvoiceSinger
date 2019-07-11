<?php

namespace InvoiceSinger\Storage\Repository;

use ArchLayer\Repository\Repository;
use InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\QuoteProductRepositoryInterface;

/**
 * Class QuoteProductRepository.
 *
 * @package InvoiceSinger\Storage\Repository
 */
class QuoteProductRepository extends Repository implements QuoteProductRepositoryInterface
{
    /**
     * QuoteProductRepository constructor.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(QuoteProductEntityInterface $entity)
    {
        $this->setModel($entity);
    }
}
