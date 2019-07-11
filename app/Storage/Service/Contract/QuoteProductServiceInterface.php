<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface QuoteProductServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface QuoteProductServiceInterface extends ServiceInterface
{
    /**
     * Find a collection of quote products that share a quote ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingQuote(string $id): Collection;

    /**
     * Attempt to find a single quote product using its ID.
     *
     * @param string $id
     *
     * @return null|\InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function findUsingId(string $id): ?QuoteProductEntityInterface;

    /**
     * Create a new quote product.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return null|\InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function create(ParameterBag $payload): ?QuoteProductEntityInterface;

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
    ): bool;

    /**
     * Delete an existing product entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(QuoteProductEntityInterface $entity): bool;
}
