<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\ProductEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class ProductEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class ProductEntity extends Model implements ProductEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'products';

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
        'price' => 'float',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'family',
        'unit',
        'price',
        'tax_rate',
    ];

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return ucwords($this->name);
    }

    /**
     * Get the SKU.
     *
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * Get the product family.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the product family.
     *
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
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
     * Get the product price.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return number_format($this->price, 2, '.', '');
    }

    /**
     * Get the tax rate ID for a product.
     *
     * @return string|null
     */
    public function getTaxRate(): ?string
    {
        return $this->tax_rate;
    }

    /**
     * Get the unit associated with a product.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function unit(): ?UnitEntityInterface
    {
        return $this->hasOne(app('product.unit.entity'), 'id', 'unit')->first();
    }

    /**
     * Get the family associated with a product.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function family(): ?ProductFamilyEntityInterface
    {
        return $this->hasOne(app('product.family.entity'), 'id', 'family')->first();
    }

    /**
     * Get the tax rate associated with a product.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function taxRate(): ?TaxRateEntityInterface
    {
        return $this->hasOne(app('product.taxRate.entity'), 'id', 'tax_rate')->first();
    }
}
