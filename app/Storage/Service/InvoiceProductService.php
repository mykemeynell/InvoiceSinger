<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface;
use InvoiceSinger\Storage\Entity\InvoiceProductEntity;
use InvoiceSinger\Storage\Repository\Contract\InvoiceProductRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceProductServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class InvoiceProductService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class InvoiceProductService extends Service implements InvoiceProductServiceInterface
{
    /**
     * InvoiceProductService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\InvoiceProductRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(InvoiceProductRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Fetch all products for an invoice ID.
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findUsingInvoiceId(string $id): Collection
    {
        return $this->getRepository()->builder()->where('invoice', $id)->get()
            ->map(static function (InvoiceProductEntity $item) {
                if ($tax_rate = $item->taxRate()) {
                    $item->tax_rate = $tax_rate;
                    $item->tax_rate['multiplier'] = $tax_rate->getMultiplier();
                } else {
                    $item->tax_rate = [
                        'name' => 'No Tax',
                        'amount' => 0,
                        'multiplier' => 1,
                        'id' => 'none',
                    ];
                }

                $item->unit = $item->unit();

                return $item;
            });
    }

    /**
     * Create a new invoice product.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(ParameterBag $payload): ?InvoiceProductEntityInterface
    {
        /** @var \InvoiceSinger\Storage\Entity\InvoiceProductEntity $user */
        $product = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $product->save();

        return $product;
    }

    /**
     * Update an existing invoice product entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                                                           $payload
     *
     * @return bool
     */
    public function update(InvoiceProductEntityInterface $entity, ParameterBag $payload): bool
    {
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing invoice product entity.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(InvoiceProductEntityInterface $entity): bool
    {
        return $entity->delete();
    }
}
