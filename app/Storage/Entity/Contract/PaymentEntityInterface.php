<?php

namespace InvoiceSinger\Storage\Entity\Contract;

use Carbon\Carbon;

/**
 * Interface PaymentEntityInterface
 *
 * @property \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|null         $invoice
 * @property \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|null   $method
 * @property float                                                                      $amount
 * @property Carbon                                                                     $paid_at
 * @property string|null                                                                $notes
 * @property string|null                                                                $payload
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface PaymentEntityInterface
{
    /**
     * Get the invoice.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function invoice(): ?InvoiceEntityInterface;

    /**
     * Get the method.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function method(): ?PaymentMethodEntityInterface;

    /**
     * Get the payment amount.
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get the paid at date.
     *
     * @return \Carbon\Carbon
     */
    public function getPaidAt(): Carbon;

    /**
     * Get the notes.
     *
     * @return string|null
     */
    public function getNotes(): ?string;

    /**
     * Get the payload.
     *
     * @return string|null
     */
    public function getPayload(): ?string;
}
