<?php

namespace InvoiceSinger\Storage\Entity\Contract;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface InvoiceEntityInterface.
 *
 * @property string              $client     The client ID.
 * @property string              $key        Otherwise known as "invoice number".
 * @property \Carbon\Carbon      $raised_at
 * @property \Carbon\Carbon      $due_at
 * @property \Carbon\Carbon|null $sent_at
 * @property string              $status
 * @property string              $payment_method
 * @property string              $terms
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface InvoiceEntityInterface
{
    /**
     * Get the client ID.
     *
     * @return string
     */
    public function getClientId(): string;

    /**
     * Get the invoice key.
     *
     * @return string
     */
    public function getInvoiceKey(): string;

    /**
     * Get the raised at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getRaisedAt(): Carbon;

    /**
     * Get the due_at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getDueAt(): Carbon;

    /**
     * Get the sent at timestamp.
     *
     * @return \Carbon\Carbon|null
     */
    public function getSentAt(): ?Carbon;

    /**
     * Get the invoice status.
     *
     * @return string
     */
    public function getStatus(): string;

    /**
     * Get the payment method set for this invoice.
     *
     * @return string
     */
    public function getPaymentMethod(): string;

    /**
     * Get the invoice terms.
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
     * Get all payments that have been assigned to this invoice.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function payments(): Collection;

    /**
     * Get the amount that is outstanding on this invoice.
     *
     * @return float
     */
    public function getBalance(): float;

    /**
     * Get the invoice total.
     *
     * @return float
     */
    public function getTotal(): float;

    /**
     * Get the amount that has been paid against this invoice.
     *
     * @return float
     */
    public function getPaid(): float;

    /**
     * Get items that have been added to this invoice.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function items(): Collection;
}
