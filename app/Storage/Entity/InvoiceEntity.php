<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Observers\CreateInvoiceKeyObserver;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use UuidColumn\Concern\HasUuidObserver;
use UuidColumn\Observer\UuidObserver;

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
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::observe(CreateInvoiceKeyObserver::class);
        self::observe(UuidObserver::class);
    }

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

    /**
     * Set the raised_at column.
     *
     * @param $value
     *
     * @return void
     */
    public function setRaisedAtAttribute($value): void
    {
        $this->attributes['raised_at'] = Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
    }

    /**
     * Set the due_at attribute.
     *
     * @param $value
     *
     * @return void
     */
    public function setDueAtAttribute($value): void
    {
        $this->attributes['due_at'] = Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
    }

    /**
     * Set the sent_at attribute.
     *
     * @param $value
     */
    public function setSentAtAttribute($value): void
    {
        if (! is_null($value) && strlen($value) > 0)) {
            $this->attributes['sent_at'] = Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
        }
    }

    /**
     * Get the associated client entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function client(): ?ClientEntityInterface
    {
        return $this->hasOne(app('client.entity'), 'id', 'client')->first();
    }

    /**
     * Get all payments that have been assigned to this invoice.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function payments(): Collection
    {
        return $this->hasMany(app('payment.entity'), 'invoice', 'id')->get();
    }

    /**
     * Get the amount that is outstanding on this invoice.
     *
     * @return float
     */
    public function getBalance(): float
    {
        return (float) $this->getTotal() - $this->getPaid();
    }

    /**
     * Get the invoice total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;

        /** @var \InvoiceSinger\Storage\Entity\InvoiceProductEntity $item */
        foreach($this->items() as $item) {
            $total += $item->getTotal();
        }

        return (float) $total;
    }

    /**
     * Get the amount that has been paid against this invoice.
     *
     * @return float
     */
    public function getPaid(): float
    {
        $paid = 0;

        /** @var \InvoiceSinger\Storage\Entity\PaymentEntity $payment */
        foreach($this->payments() as $payment)
        {
            $paid += $payment->getAmount();
        }

        return (float) $paid;
    }

    /**
     * Get items that have been added to this invoice.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function items(): Collection
    {
        return $this->hasMany(app('invoice.product.entity'), 'invoice')->get()
            ->map(static function (InvoiceProductEntity $item) {
                if ($tax_rate = $item->taxRate()) {
                    /** @var \InvoiceSinger\Storage\Entity\TaxRateEntity $tax_rate */
                    $tax_rate->forceFill(['multiplier' => $tax_rate->getMultiplier()]);
                    $item->tax_rate = $tax_rate;
                } else {
                    $item->tax_rate = app('product.taxRate.entity')->forceFill([
                        'name' => 'No Tax',
                        'amount' => 0,
                        'multiplier' => 1,
                        'id' => 'none',
                    ]);
                }

                $item->unit = $item->unit();

                return $item;
            });
    }
}
