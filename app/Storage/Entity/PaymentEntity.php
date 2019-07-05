<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class PaymentEntity
 *
 * @package InvoiceSinger\Storage\Entity
 */
class PaymentEntity extends Model implements PaymentEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'payments';

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
        'paid_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'method',
        'amount',
        'paid_at',
        'notes',
        'payload',
        'committed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
        'committed' => 'bool',
    ];

    /**
     * Get the invoice.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function invoice(): ?InvoiceEntityInterface
    {
        return $this->hasOne(app('invoice.entity'), 'id', 'invoice')->first();
    }

    /**
     * Get the method.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function method(): ?PaymentMethodEntityInterface
    {
        return $this->hasOne(app('payment.method.entity'), 'id', 'method')->first();
    }

    /**
     * Get the payment amount.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the paid at date.
     *
     * @return \Carbon\Carbon
     */
    public function getPaidAt(): Carbon
    {
        return $this->paid_at;
    }

    /**
     * Get the notes.
     *
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * Get the payload.
     *
     * @return string|null
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }
}
