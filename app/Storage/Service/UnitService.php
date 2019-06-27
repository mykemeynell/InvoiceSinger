<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\UnitRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\UnitServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class UnitService
 *
 * @package InvoiceSinger\Storage\Service
 */
class UnitService extends Service implements UnitServiceInterface
{
    /**
     * UnitService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\UnitRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(UnitRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Find an existing unit entity using its ID.
     *
     * @param string $id
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id): ?UnitEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Fetch all unit entities from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Create a new unit entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?UnitEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\UnitEntity $unit */
        $unit = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $unit->save();

        return $unit;
    }

    /**
     * Update an existing unit entity and save the changes to the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                 $payload
     *
     * @return bool
     */
    public function update(UnitEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete a unit from the database.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(UnitEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
