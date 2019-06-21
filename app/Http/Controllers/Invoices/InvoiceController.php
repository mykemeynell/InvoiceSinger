<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
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
            ->with('clients', $this->getService('clients')->fetch())
            ->with('invoices', $this->getService('invoices')->fetch());
    }
}
