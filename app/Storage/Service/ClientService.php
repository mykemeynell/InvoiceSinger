<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ClientService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class ClientService extends Service implements ClientServiceInterface
{
    /**
     * ClientService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(ClientRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Find a client using a given field. ID by default.
     *
     * @param string $value
     * @param string $match
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $value, $match = 'id'): ?ClientEntityInterface
    {
        return $this->getRepository()->builder()->where($match, $value)->first();
    }

    /**
     * Create a new client.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?ClientEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\ClientEntity $user */
        $client = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $client->save();

        return $client;
    }

    /**
     * Update a client. The $match parameter is used to match an existing entry.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                   $payload
     *
     * @return bool
     */
    public function update(ClientEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable()));
    }

    /**
     * Delete an existing client.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     */
    public function delete(ClientEntityInterface $entity): bool
    {
        return $this->getRepository()->delete($entity);
    }
}
