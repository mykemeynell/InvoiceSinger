<?php

namespace InvoiceSinger\Http\Controllers\Payments;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Payment\CreatePaymentRequest;
use InvoiceSinger\Storage\Service\Contract\PaymentServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use mykemeynell\Support\CurrencyHtmlEntities;
use Symfony\Component\HttpFoundation\ParameterBag;

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

    /**
     * Handle post request for creating a new payment entry.
     *
     * @param \InvoiceSinger\Http\Requests\Payment\CreatePaymentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(CreatePaymentRequest $request): RedirectResponse
    {
        try {
            $paid_at = implode([
                $request->getParameterBag()->get('paid_at_hour'),
                $request->getParameterBag()->get('paid_at_time'),
            ], ' ');

            /** @var \InvoiceSinger\Storage\Entity\PaymentEntity $payment */
            $payment = $this->getService()->create(new ParameterBag([
                'invoice' => $request->invoice()->getKey(),
                'method' => $request->method()->getKey(),
                'amount' => $request->getParameterBag()->get('amount'),
                'paid_at' => Carbon::createFromFormat('d F Y h:i A', $paid_at)->format('Y-m-d H:i:s'),
            ]));

            switch ($request->referrer()->getName()) {
                case 'invoices.form':
                    return RedirectResponse::create(route($request->referrer()->getName(),
                        $request->invoice()->getKey()));
                    break;

                case 'payments':
                    return RedirectResponse::create(route($request->referrer()->getName()));
                    break;

                default:
                    return abort(404);
                    break;
            }

        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
