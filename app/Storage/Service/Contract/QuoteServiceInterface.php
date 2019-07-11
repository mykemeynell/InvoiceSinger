<?php

namespace InvoiceSinger\Storage\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface QuoteServiceInterface.
 *
 * @package InvoiceSinger\Storage\Service\Contract
 */
interface QuoteServiceInterface extends ServiceInterface
{
    /**
     * Fetch all quotes from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection;

    /**
     * Attempt to find a quote using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingId(string $id): ?QuoteEntityInterface;

    /**
     * Find a collection of quotes by the client ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingClient(string $id): Collection;

    /**
     * Create a new quote entity and save to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function create(ParameterBag $payload): QuoteEntityInterface;

    /**
     * Update an existing quote entity in the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                  $payload
     *
     * @return bool
     */
    public function update(
        QuoteEntityInterface $entity,
        ParameterBag $payload
    ): bool;

    /**
     * Delete an existing quote entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(QuoteEntityInterface $entity): bool;
}
