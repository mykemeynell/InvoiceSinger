<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class InvoiceController
 *
 * @package InvoiceSinger\Http\Controllers\Invoices
 */
class InvoiceController extends Controller
{
    use HasService;

    /**
     * InvoiceController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface $invoiceService
     * @param \InvoiceSinger\Storage\Service\Contract\ClientServiceInterface  $clientService
     */
    function __construct(InvoiceServiceInterface $invoiceService, ClientServiceInterface $clientService)
    {
        $this->setService($invoiceService, 'invoices');
        $this->setService($clientService, 'clients');
    }

    /**
     * Get the list of invoices.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('invoices')
            ->with('today', Carbon::today()->format('d F Y'))
            ->with('due', Carbon::today()->add(settings('invoice.term'))->format('d F Y'))
            ->with('clients', $this->getService('clients')->fetch())
            ->with('invoices', $this->getService('invoices')->fetch());
    }

    /**
     * Display the invoice form.
     *
     * @param \InvoiceSinger\Http\Requests\Invoice\InvoiceRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function form(InvoiceRequest $request): View
    {
        return view('invoices.form')
            ->with('invoice', $request->invoice());
    }

    /**
     * Handle the submission of data to invoices.
     *
     * @param \InvoiceSinger\Http\Requests\Invoice\InvoiceRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(InvoiceRequest $request): RedirectResponse
    {
        try {
            if ($invoice = $request->invoice()) {
                /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $invoice */
                $invoice = $this->getService('invoices')->update($invoice, $request->getParameterBag());

                return RedirectResponse::create(route('invoices.form', ['invoice_id' => $invoice->getKey()]));
            }

            /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $invoice */
            $invoice = $this->getService('invoices')->create($request->getParameterBag());

            return RedirectResponse::create(route('invoices.form', ['invoice_id' => $invoice->getKey()]));
        } catch (\Exception $exception) {
            return abort(500, $exception->getMessage());
        }
    }
}
