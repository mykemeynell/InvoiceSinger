<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\QuoteRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\QuoteServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class QuoteService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class QuoteService extends Service implements QuoteServiceInterface
{
    private const COL_CLIENT = 'client';
    private const COL_ISSUED_AT = 'issued_at';

    /**
     * QuoteService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\QuoteRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(QuoteRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Fetch all quotes from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()
            ->orderBy(self::COL_ISSUED_AT, 'desc')->get();
    }

    /**
     * Attempt to find a quote using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingId(string $id): ?QuoteEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Find a collection of quotes by the client ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingClient(string $id): Collection
    {
        return $this->getRepository()->builder()
            ->where(self::COL_CLIENT, $id)->get();
    }

    /**
     * Create a new quote entity and save to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function create(ParameterBag $payload): QuoteEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\QuoteEntity $quote */
        $quote = $this->getRepository()->create(
            Arr::only($payload->all(),
                $this->getRepository()->getModel()->getFillable())
        );
        $quote->save();

        return $quote;
    }

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
    ): bool {
        return $entity->update(
            Arr::only($payload->all(), $entity->getFillable())
        );
    }

    /**
     * Delete an existing quote entity from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(QuoteEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
