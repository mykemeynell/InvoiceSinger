<?php

namespace InvoiceSinger\PaymentProviders;

use Illuminate\Http\Request;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Support\Encryption\Cryptor;
use Ramsey\Uuid\Uuid;

/**
 * Class PaymentProvider.
 *
 * @package InvoiceSinger\PaymentProviders
 */
abstract class PaymentProvider
{
    /**
     * Identifier for transaction.
     *
     * @var \Ramsey\Uuid\UuidInterface
     */
    protected $id;

    /**
     * The cryptor.
     *
     * @var \InvoiceSinger\Support\Encryption\Cryptor
     */
    protected $cryptor;

    /**
     * Invoice entity.
     *
     * @var \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface
     */
    protected $invoice;

    /**
     * The request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * PaymentProvider constructor.
     *
     * @param \InvoiceSinger\Support\Encryption\Cryptor $cryptor
     *
     * @throws \Exception
     */
    function __construct(Cryptor $cryptor)
    {
        $this->cryptor = $cryptor;
        $this->id = Uuid::uuid4();
    }

    /**
     * Prepare the Payment Provider instance with data from the invoice and the
     * current request.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface $invoice
     * @param \Illuminate\Http\Request                                      $request
     */
    public function boot(InvoiceEntityInterface $invoice, Request $request): void
    {
        $this->invoice = $invoice;
        $this->request = $request;
    }

    /**
     * Handle the creation of a payment instance.
     *
     * @return mixed
     */
    abstract public function handle();

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Anything that should be added to the frontend, for example:
     *  return "<script>PaymentProvider.addKey(settings('keyname'));</script>";
     *
     * @return string
     */
    abstract public function getFrontendAdditions(): string;

    /**
     * Get the fields that are required by this provider.
     *
     * Format:
     *  [
     *    'label' => '',
     *    'type' => '',
     *    'name' => '',
     *    'required' => true|false,
     *    'encrypt' => true|false,
     *  ]
     *
     * @return array
     */
    abstract public function getFields(): array;

    /**
     * Get the success URL.
     *
     * @return string
     */
    public function getSuccessUrl(): string
    {
        return route('payment.success', ['k' => $this->id->toString()]);
    }

    /**
     * Get the error URL.
     *
     * @return string
     */
    public function getErrorUrl(): string
    {
        return route('payment.error', ['k' => $this->id->toString()]);
    }
}
