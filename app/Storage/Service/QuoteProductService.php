<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\QuoteProductRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\QuoteProductServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class QuoteProductService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class QuoteProductService extends Service implements QuoteProductServiceInterface
{
    private const COL_QUOTE_ID = 'quote';

    /**
     * QuoteProductService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\QuoteProductRepositoryInterface $repository
     */
    function __construct(QuoteProductRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Delete all quote products that have a defined quote ID.
     *
     * @param string $id
     *
     * @return bool
     */
    public function removeUsingQuoteId(string $id): bool
    {
        return $this->getRepository()->builder()->where(self::COL_QUOTE_ID,
            $id)->forceDelete();
    }

    /**
     * Find a collection of quote products that share a quote ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingQuote(string $id): Collection
    {
        return $this->getRepository()->builder()->where(self::COL_QUOTE_ID,
            $id)->get();
    }

    /**
     * Attempt to find a single quote product using its ID.
     *
     * @param string $id
     *
     * @return null|\InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function findUsingId(string $id): ?QuoteProductEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Create a new quote product.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return null|\InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function create(ParameterBag $payload): ?QuoteProductEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\QuoteProductEntity $product */
        $product = $this->getRepository()->create(
            Arr::only($payload->all(),
                $this->getRepository()->getModel()->getFillable())
        );
        $product->save();

        return $product;
    }

    /**
     * Update an existing quote product.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                         $payload
     *
     * @return bool
     */
    public function update(
        QuoteProductEntityInterface $entity,
        ParameterBag $payload
    ): bool {
        return $entity->update(
            Arr::only($payload->all(), $entity->getFillable())
        );
    }

    /**
     * Delete an existing product entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(QuoteProductEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
