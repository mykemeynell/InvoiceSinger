<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvoiceSinger\Observers\CreateInvoiceKeyObserver;
use InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\QuoteEntityInterface;
use UuidColumn\Observer\UuidObserver;

/**
 * Class QuoteEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class QuoteEntity extends Model implements QuoteEntityInterface
{
    use EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'quotes';

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
        'issued_at',
        'expires_at',
        'approved_at',
        'rejected_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client',
        'key',
        'status',
        'terms',
        'issued_at',
        'expires_at',
        'sent_at',
        'approved_at',
        'rejected_at',
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
     * Get the quote key.
     *
     * @return string
     */
    public function getQuoteKey(): string
    {
        return $this->key;
    }

    /**
     * Get the issued at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getIssuedAt(): Carbon
    {
        return $this->issued_at;
    }

    /**
     * Get the expires at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getExpiresAt(): Carbon
    {
        return $this->expires_at;
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
     * Get the approved at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getApprovedAt(): Carbon
    {
        return $this->approved_at;
    }

    /**
     * Get the rejected at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getRejectedAt(): Carbon
    {
        return $this->rejected_at;
    }

    /**
     * Get the quote status.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the quote terms.
     *
     * @return string|null
     */
    public function getTerms(): ?string
    {
        return $this->terms;
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
     * Get items that have been added to this quote.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function items(): Collection
    {
        return $this->hasMany(app('quote.product.entity'), 'quote')->get()
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

    /**
     * Get the quote total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;

        /** @var \InvoiceSinger\Storage\Entity\QuoteProductEntity $item */
        foreach ($this->items() as $item) {
            $total += $item->getTotal();
        }

        return (float)$total;
    }
}
