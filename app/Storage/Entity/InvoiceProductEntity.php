<?php

namespace InvoiceSinger\Storage\Entity;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\InvoiceProductEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;

/**
 * Class InvoiceProduct.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class InvoiceProductEntity extends Model implements InvoiceProductEntityInterface
{/**
 * The table name.
 *
 * @var string
 */
    public $table = 'invoice_products';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'float',
        'subtotal' => 'float',
        'discount' => 'float',
        'total' => 'float',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'name',
        'quantity',
        'unit',
        'subtotal',
        'tax_rate',
        'discount',
        'total',
    ];

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->name;
    }

    /**
     * Get the quantity.
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * Get the unit.
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Get the subtotal.
     *
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Get the tax rate.
     *
     * @return string|null
     */
    public function getTaxRate(): ?string
    {
        return $this->tax_rate;
    }

    /**
     * Get the discount.
     *
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Get the total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * Get the tax rate entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function taxRate(): TaxRateEntityInterface
    {
        if($tax_rate = $this->hasOne(app('product.taxRate.entity'), 'id', 'tax_rate')->first()) {
            return $tax_rate;
        } else {
            return app('product.taxRate.entity')->forceFill([
                'id' => 'none',
                'name' => 'No Tax',
                'multiplier' => 1,
                'amount' => 0
            ]);
        }
    }

    /**
     * Get the unit entity interface.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function unit(): UnitEntityInterface
    {
        return $this->hasOne(app('product.unit.entity'), 'id', 'unit')->first();
    }

    /**
     * Get the invoice ID.
     *
     * @return string
     */
    public function getInvoice(): string
    {
        return $this->invoice;
    }

    /**
     * Get the invoice entity.
     *
     * @return \InvoiceSinger\Storage\Entity\InvoiceEntity|\Illuminate\Database\Eloquent\Model
     */
    public function invoice(): InvoiceEntity
    {
        return $this->hasOne(app('invoice.entity'), 'id', 'invoice')->first();
    }
}
