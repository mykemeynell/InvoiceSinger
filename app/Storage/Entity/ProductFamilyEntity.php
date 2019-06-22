<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\ProductFamilyEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class ProductFamilyEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class ProductFamilyEntity extends Model implements ProductFamilyEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'product_families';

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
        'name',
    ];

    /**
     * Get the display name of the product family.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return ucwords($this->name);
    }
}
