<?php

namespace InvoiceSinger\PaymentProviders;

use Carbon\Carbon;
use Illuminate\Http\Request;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use InvoiceSinger\Support\Encryption\Cryptor;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PaymentProvider.
 *
 * @package InvoiceSinger\PaymentProviders
 */
abstract class PaymentProvider
{
    /**
     * Payment method.
     *
     * @var \InvoiceSinger\Storage\Entity\Contract\PaymentMethodEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    private $payment_method;

    /**
     * Payment service.
     *
     * @var \InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface|\ArchLayer\Service\Service
     */
    private $payment_service;

    /**
     * Payment.
     *
     * @var \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model
     */
    private $payment;

    /**
     * The cryptor.
     *
     * @var \InvoiceSinger\Support\Encryption\Cryptor
     */
    protected $cryptor;

    /**
     * Invoice entity.
     *
     * @var \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model
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
     * @param \InvoiceSinger\Support\Encryption\Cryptor                             $cryptor
     *
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface $payment_method_service
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface       $payment_service
     */
    function __construct(Cryptor $cryptor, PaymentMethodServiceInterface $payment_method_service, PaymentServiceInterface $payment_service)
    {
        $this->cryptor = $cryptor;
        $this->payment_method = $payment_method_service->findUsingSlug('online');
        $this->payment_service = $payment_service;
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
     * Get the payment entity.
     *
     * @return \InvoiceSinger\Storage\Entity\Contract\PaymentEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    final public function getPaymentEntity(): ?PaymentEntityInterface
    {
        return $this->payment;
    }

    /**
     * Prepare the Payment Provider instance with data from the invoice and the
     * current request.
     *
     * @param \InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface|\Illuminate\Database\Eloquent\Model $invoice
     * @param \Illuminate\Http\Request                                                                          $request
     */
    public function boot(InvoiceEntityInterface $invoice, Request $request): void
    {
        $this->invoice = $invoice;
        $this->request = $request;

        $this->payment = $this->payment_service->create(new ParameterBag([
            'invoice' => $invoice->getKey(),
            'method' => $this->payment_method->getKey(),
            'amount' => $invoice->getTotal(),
            'paid_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'committed' => 0,
        ]));
    }

    /**
     * Commit the changes to the database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Exception
     */
    final public function commit(Request $request): void
    {
        if($invoice_id = $request->get('invoice_id') === null) {
            throw new \Exception("Missing invoice key");
        }

        /** @var \InvoiceSinger\Storage\Entity\PaymentEntity $payment */
        $payment = $this->payment_service->findUsingInvoiceId($request->get('payment'));
        $this->payment_service->update($payment, new ParameterBag([
            'committed' => 1,
            "invoice" => $invoice_id,
        ]));
    }

    /**
     * Get the success URL.
     *
     * @return string
     */
    final public function getSuccessUrl(): string
    {
        return route('payment.success', [
            'payment_id' => "{$this->payment->getKey()}",
            'invoice_id' => "{$this->invoice->getKey()}",
        ]);
    }

    /**
     * Get the error URL.
     *
     * @return string
     */
    final public function getErrorUrl(): string
    {
        return route('payment.error', [
            'payment_id' => "{$this->payment->getKey()}",
            'invoice_id' => "{$this->invoice->getKey()}",
        ]);
    }

    /**
     * Get the success webhook URL.
     *
     * @return string
     */
    final public function getSuccessWebhookUrl(): string
    {
        return route('webhook.payment.success', [
            'payment_id' => "{$this->payment->getKey()}",
            'invoice_id' => "{$this->invoice->getKey()}",
        ]);
    }

    /**
     * Get the error webhook URL.
     *
     * @return string
     */
    final public function getErrorWebhookUrl(): string
    {
        return route('webhook.payment.error', [
            'payment_id' => "{$this->payment->getKey()}",
            'invoice_id' => "{$this->invoice->getKey()}",
        ]);
    }
}
