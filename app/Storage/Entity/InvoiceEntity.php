<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class InvoiceEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class InvoiceEntity extends Model implements InvoiceEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'invoices';

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
        'raised_at',
        'due_at',
        'sent_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client',
        'key',
        'raised_at',
        'due_at',
        'sent_at',
        'status',
        'payment_method',
        'terms',
    ];

    /**
     * Get the client ID.
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client;
    }

    /**
     * Get the invoice key.
     *
     * @return string
     */
    public function getInvoiceKey(): string
    {
        return $this->key;
    }

    /**
     * Get the raised at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getRaisedAt(): Carbon
    {
        return $this->raised_at;
    }

    /**
     * Get the due_at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getDueAt(): Carbon
    {
        return $this->due_at;
    }

    /**
     * Get the sent at timestamp.
     *
     * @return \Carbon\Carbon|null
     */
    public function getSentAt(): ?Carbon
    {
        return $this->sent_at;
    }

    /**
     * Get the invoice status.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the payment method set for this invoice.
     *
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->payment_method;
    }

    /**
     * Get the invoice terms.
     *
     * @return string|null
     */
    public function getTerms(): ?string
    {
        return $this->terms;
    }
}
