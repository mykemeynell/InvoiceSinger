<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class InvoiceController
 *
 * @method InvoiceServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Invoices
 */
class InvoiceController extends Controller
{
    use HasService;

    /**
     * InvoiceController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface $service
     */
    function __construct(InvoiceServiceInterface $service)
    {
        $this->setService($service);
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
            ->with('invoices', $this->getService()->fetch());
    }
}
