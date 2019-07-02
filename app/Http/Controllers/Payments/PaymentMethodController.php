<?php

namespace InvoiceSinger\Http\Controllers\Payments;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class PaymentMethodController
 *
 * @method PaymentMethodServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Payments
 */
class PaymentMethodController extends Controller
{
    use HasService;

    /**
     * PaymentMethodController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface $service
     */
    function __construct(PaymentMethodServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Show the list view of payment methods.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('payment-methods.payment-methods')
            ->with('methods', $this->getService()->fetch());
    }
}
