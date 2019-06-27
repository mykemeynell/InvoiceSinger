<?php

namespace InvoiceSinger\Storage\Entity;

use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\TaxRateEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class TaxRateEntity
 *
 * @package InvoiceSinger\Storage\Entity
 */
class TaxRateEntity extends Model implements TaxRateEntityInterface
{
    use HasUuidObserver;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tax_rates';

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
        'amount',
    ];

    /**
     * Get the display name of the tax rate.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return ucwords($this->name);
    }

    /**
     * Get the amount of the tax rate.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the multiplier value for this tax rate.
     *
     * @return float
     */
    public function getMultiplier(): float
    {
        return (100 + $this->getAmount()) / 100;
    }

    /**
     * Get the tax rate as it would appear in a list.
     *
     * @return string
     */
    public function getInformativeName(): string
    {
        return "{$this->getDisplayName()} ({$this->getAmount()}%)";
    }
}
