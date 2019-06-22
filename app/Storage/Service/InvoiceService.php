<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\InvoiceRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class InvoiceService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class InvoiceService extends Service implements InvoiceServiceInterface
{
    /**
     * Find a client using a given field. ID by default.
     *
     * @param string $value
     * @param string $match
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $value, $match = 'id'): ?InvoiceEntityInterface
    {
        return $this->getRepository()->builder()->where($match, $value)->first();
    }

    /**
     * Fetch all invoices.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->orderBy('created_at', 'desc')->get();
    }

    /**
     * InvoiceService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\InvoiceRepositoryInterface $repository
     */
    function __construct(InvoiceRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Create a new invoice item.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface
     */
    public function create(ParameterBag $payload): InvoiceEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $invoice */
        $invoice = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $invoice->save();

        return $invoice;
    }

    /**
     * Update an existing invoice item.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                    $payload
     *
     * @return bool
     */
    public function update(InvoiceEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing invoice item.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(InvoiceEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
