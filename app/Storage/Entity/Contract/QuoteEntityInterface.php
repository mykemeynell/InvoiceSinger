<?php

namespace InvoiceSinger\Storage\Entity\Contract;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface QuoteEntityInterface.
 *
 * @property string         $client
 * @property string         $key
 * @property string         $status
 * @property string         $terms
 * @property \Carbon\Carbon $issued_at
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon $sent_at
 * @property \Carbon\Carbon $approved_at
 * @property \Carbon\Carbon $rejected_at
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface QuoteEntityInterface
{
    /**
     * Get the client ID.
     *
     * @return string
     */
    public function getClientId(): string;

    /**
     * Get the quote key.
     *
     * @return string
     */
    public function getQuoteKey(): string;

    /**
     * Get the issued at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getIssuedAt(): Carbon;

    /**
     * Get the expires at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getExpiresAt(): Carbon;

    /**
     * Get the sent at timestamp.
     *
     * @return \Carbon\Carbon|null
     */
    public function getSentAt(): ?Carbon;

    /**
     * Get the approved at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getApprovedAt(): Carbon;

    /**
     * Get the rejected at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getRejectedAt(): Carbon;

    /**
     * Get the quote status.
     *
     * @return string
     */
    public function getStatus(): string;

    /**
     * Get the quote terms.
     *
     * @return string|null
     */
    public function getTerms(): ?string;

    /**
     * Get the associated client entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\ClientEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function client(): ?ClientEntityInterface;

    /**
     * Get items that have been added to this quote.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function items(): Collection;

    /**
     * Get the quote total.
     *
     * @return float
     */
    public function getTotal(): float;
}
