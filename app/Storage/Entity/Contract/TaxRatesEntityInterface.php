<?php

namespace InvoiceSinger\Storage\Entity\Contract;

/**
 * Interface TaxRatesEntityInterface
 *
 * @property string $name
 * @property string $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface TaxRatesEntityInterface
{
    /**
     * Get the display name of the tax rate.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the amount of the tax rate.
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get the multiplier value for this tax rate.
     *
     * @return float
     */
    public function getMultiplier(): float;
}
