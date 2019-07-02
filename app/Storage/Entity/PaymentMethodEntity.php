<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class PaymentMethodEntity
 *
 * @package InvoiceSinger\Storage\Entity
 */
class PaymentMethodEntity extends Model implements PaymentMethodEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'payment_methods';

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
        'protected' => 'bool',
        'enabled' => 'bool'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'is_protected',
        'is_enabled',
    ];

    /**
     * Get the display name of the payment method.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return ucwords($this->name);
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Test if method is protected.
     *
     * @return bool
     */
    public function isProtected(): bool
    {
        return $this->protected;
    }

    /**
     * Test if method is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
