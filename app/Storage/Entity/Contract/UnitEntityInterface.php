<?php

namespace InvoiceSinger\Storage\Entity\Contract;

/**
 * Interface UnitEntityInterface.
 *
 * @property string              $name
 * @property string              $unit
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface UnitEntityInterface
{
    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the unit value.
     *
     * @return string
     */
    public function getUnit(): string;
}
