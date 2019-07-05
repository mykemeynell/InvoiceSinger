<?php

namespace InvoiceSinger\PaymentProviders\Stripe;

use InvoiceSinger\PaymentProviders\PaymentProvider;
use InvoiceSinger\Storage\Entity\Contract\InvoiceEntityInterface;
use InvoiceSinger\Storage\Entity\InvoiceProductEntity;
use InvoiceSinger\Support\Encryption\Cryptor;
use Stripe\Checkout\Session;
use Stripe\Stripe;

/**
 * Class StripePaymentProvider.
 *
 * @package InvoiceSinger\PaymentProviders\Stripe
 */
class StripePaymentProvider extends PaymentProvider
{
    /**
     * The session ID.
     *
     * @var string
     */
    protected $session_id;

    /**
     * Handle the creation of a payment instance.
     *
     * @return mixed
     */
    public function handle()
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey(
            $this->cryptor->decrypt(settings('stripe.secret_key'))
        );

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $this->invoice->client()->getEmailAddress(),
            'line_items' => [[
                'name' => "{$this->invoice->getInvoiceKey()}",
                'description' => "Invoice #{$this->invoice->getInvoiceKey()}",
                'amount' => $this->invoice->getTotal() * 100,
                'quantity' => 1,
                'currency' => strtolower(currency()),
            ]],
            'success_url' => $this->getSuccessUrl(),
            'cancel_url' => $this->getErrorUrl(),
        ]);

        $this->session_id = $session->id;
    }

    /**
     * The name of the payment provider.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Stripe';
    }

    /**
     * Anything that should be added to the frontend, for example:
     *  return "<script>PaymentProvider.addKey(settings('keyname'));</script>";
     *
     * @return string
     */
    public function getFrontendAdditions(): string
    {
        $lines = [
            '<script src="https://js.stripe.com/v3/"></script>',
            '<script>',
            '    $(document).ready(function() {',
            '        let stripe_token = "' . $this->cryptor->decrypt(settings('stripe.publishable_key')) . '";',
            '        if(stripe_token.length <= 0) {',
            '            console.error("Stripe publishable token has not been set");',
            '        }',
            '        let stripe = Stripe(stripe_token);',
            '        stripe.redirectToCheckout({',
            '            sessionId: "' . $this->session_id . '"',
            '        }).then(function (result) {',
            '            console.error(result.error.message);',
            '        });',
            '    });',
            '</script>',
        ];

        return implode("\r\n", $lines);
    }

    /**
     * Get the fields that are required by this povider.
     *
     * @return array
     */
    public function getFields(): array
    {
        return [
            [
                'label' => 'Publishable Key',
                'type' => 'text',
                'name' => 'stripe.publishable_key',
                'required' => true,
                'encrypt' => true,
            ],
            [
                'label' => 'Secret Key',
                'type' => 'text',
                'name' => 'stripe.secret_key',
                'required' => true,
                'encrypt' => true,
            ]
        ];
    }
}
