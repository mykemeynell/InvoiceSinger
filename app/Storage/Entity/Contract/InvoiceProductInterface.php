<?php

namespace InvoiceSinger\Storage\Entity\Contract;

use InvoiceSinger\Storage\Entity\InvoiceEntity;

/**
 * Interface InvoiceProductInterface.
 *
 * @property string      $invoice
 * @property string      $name
 * @property float       $quantity
 * @property string      $unit
 * @property float       $subtotal
 * @property string|null $tax_rate
 * @property float       $discount
 * @property float       $total
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface InvoiceProductInterface
{
    /**
     * Get the invoice ID.
     *
     * @return string
     */
    public function getInvoice(): string;

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the quantity.
     *
     * @return float
     */
    public function getQuantity(): float;

    /**
     * Get the unit.
     *
     * @return string
     */
    public function getUnit(): string;

    /**
     * Get the subtotal.
     *
     * @return float
     */
    public function getSubtotal(): float;

    /**
     * Get the tax rate.
     *
     * @return string|null
     */
    public function getTaxRate(): ?string;

    /**
     * Get the discount.
     *
     * @return float
     */
    public function getDiscount(): float;

    /**
     * Get the total.
     *
     * @return float
     */
    public function getTotal(): float;

    /**
     * Get the tax rate entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function taxRate(): TaxRateEntityInterface;

    /**
     * Get the unit entity interface.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function unit(): UnitEntityInterface;

    /**
     * Get the invoice entity.
     *
     * @return \InvoiceSinger\Storage\Entity\InvoiceEntity|\Illuminate\Database\Eloquent\Model
     */
    public function invoice(): InvoiceEntity;
}
