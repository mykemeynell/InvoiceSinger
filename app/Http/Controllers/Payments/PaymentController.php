<?php

namespace InvoiceSinger\Http\Controllers\Payments;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use mykemeynell\Support\CurrencyHtmlEntities;

/**
 * Class PaymentController
 *
 * @method PaymentServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Payments
 */
class PaymentController extends Controller
{
    use HasService;

    /**
     * PaymentController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface $service
     */
    function __construct(PaymentServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Display list view for payments.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        $che = app()->make(CurrencyHtmlEntities::class);

        return view('payments')
            ->with('currency', $che->entity(settings('app.currency')))
            ->with('payments', $this->getService()->fetch());
    }
}
