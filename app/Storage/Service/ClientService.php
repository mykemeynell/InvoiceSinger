<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as IlluminateCollection;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Repository\Contract\ClientRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use League\ISO3166\ISO3166;
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
     * Fetch all clients.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetch(): Collection
    {
        return $this->getRepository()->builder()->get();
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

    /**
     * Get the address as an object.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface $entity
     * @param bool                                                         $include_business_name
     *
     * @return \Illuminate\Support\Collection
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getAddressObject(ClientEntityInterface $entity, $include_business_name = false): IlluminateCollection
    {
        return collect([
            'name' => implode(" ", [
                $entity->getTitle(),
                $entity->getFirstName(),
                $entity->getLastName(),
            ]),
            'business_name' => $include_business_name ? $entity->getBusinessName() : '',
            'address_1' => $entity->getAddress1(),
            'address_2' => $entity->getAddress2(),
            'city' => $entity->getTownCity(),
            'postcode' => $entity->getPostcode(),
            'country' => app()->make(ISO3166::class)->alpha3(
                $entity->getCountry()
            )['name'],
        ]);
    }
}
