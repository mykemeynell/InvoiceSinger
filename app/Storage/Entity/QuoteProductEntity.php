<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\QuoteProductEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

class QuoteProductEntity extends Model implements QuoteProductEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'quote_products';

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quote',
        'name',
        'description',
        'price',
        'quantity',
        'unit',
        'subtotal',
        'tax_rate',
        'discount',
        'total',
    ];

    /**
     * Get the invoice ID.
     *
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }

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
     * Get the description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
     * Get the item price.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Get the tax rate entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function taxRate(): TaxRateEntityInterface
    {
        return $this->hasOne(app('product.taxRate.entity'), 'id',
            'tax_rate')->first();
    }

    /**
     * Get the unit entity interface.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function unit(): UnitEntityInterface
    {
        return $this->hasOne(app('product.unit.entity'), 'id',
            'unit')->first();
    }

    /**
     * Get the quote entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    public function quote(): QuoteEntityInterface
    {
        return $this->hasOne(app('quote.entity'), 'id',
            'quote')->first();
    }
}
