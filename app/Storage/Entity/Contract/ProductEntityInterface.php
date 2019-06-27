<?php

namespace InvoiceSinger\Storage\Entity\Contract;

/**
 * Interface ProductEntityInterface.
 *
 * @property string              $name
 * @property string|null         $sku
 * @property string|null         $description
 * @property string              $family
 * @property string              $unit
 * @property string              $price
 * @property string|null         $tax_rate
 *
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface ProductEntityInterface
{
    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the SKU.
     *
     * @return string|null
     */
    public function getSku(): ?string;

    /**
     * Get the product family.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Get the product family.
     *
     * @return string
     */
    public function getFamily(): string;

    /**
     * Get the unit.
     *
     * @return string
     */
    public function getUnit(): string;

    /**
     * Get the product price.
     *
     * @return float
     */
    public function getPrice(): float;

    /**
     * Get the tax rate ID for a product.
     *
     * @return string|null
     */
    public function getTaxRate(): ?string;
}
