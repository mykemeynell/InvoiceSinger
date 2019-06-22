<?php

namespace InvoiceSinger\Storage\Entity\Contract;

/**
 * Interface ProductFamilyEntityInterface
 *
 * @property string $name
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface ProductFamilyEntityInterface
{
    /**
     * Get the display name of the product family.
     *
     * @return string
     */
    public function getDisplayName(): string;
}
