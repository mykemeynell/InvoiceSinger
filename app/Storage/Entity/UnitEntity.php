<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\UnitEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class UnitEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class UnitEntity extends Model implements UnitEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'unit',
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
     * Get the unit value.
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
