<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use ArchLayer\Service\Contract\ServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use InvoiceSinger\Support\Generators\Invoices\InvoiceKeyGenerator;
use InvoiceSinger\Support\Generators\PatternOptions;

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
     * @return \Illuminate\View\View
     */
    public function form(): View
    {
        return view('invoices.form');
    }

    /**
     * Handle the submission of data to invoices.
     *
     * @param \InvoiceSinger\Http\Requests\Invoice\InvoiceRequest $request
     */
    public function handlePost(InvoiceRequest $request)
    {}
}
