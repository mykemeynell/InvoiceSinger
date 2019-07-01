<?php

namespace InvoiceSinger\Http\Controllers\Invoices;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceProductServiceInterface;
use InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class InvoiceController
 *
 * @package InvoiceSinger\Http\Controllers\Invoices
 */
class InvoiceController extends Controller
{
    use HasService;

    const SERVICE_INVOICE = 'invoices';
    const SERVICE_INVOICE_PRODUCT = 'invoiceProducts';
    const SERVICE_CLIENT = 'clients';

    /**
     * InvoiceController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\InvoiceServiceInterface $invoiceService
     * @param \InvoiceSinger\Storage\Service\Contract\ClientServiceInterface $clientService
     * @param \InvoiceSinger\Storage\Service\Contract\InvoiceProductServiceInterface $invoiceProductService
     */
    function __construct(
        InvoiceServiceInterface $invoiceService,
        ClientServiceInterface $clientService,
        InvoiceProductServiceInterface $invoiceProductService
    ) {
        $this->setService($invoiceService, self::SERVICE_INVOICE);
        $this->setService($invoiceProductService, self::SERVICE_INVOICE_PRODUCT);
        $this->setService($clientService, self::SERVICE_CLIENT);
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
            ->with('clients', $this->getService(self::SERVICE_CLIENT)->fetch())
            ->with('invoices', $this->getService(self::SERVICE_INVOICE)->fetch());
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
            /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $invoice */
            if ($invoice = $request->invoice()) {
                $this->getService(self::SERVICE_INVOICE)->update($invoice, $request->getParameterBag());

                $this->getService(self::SERVICE_INVOICE_PRODUCT)->removeUsingInvoiceId($invoice->getKey());
                foreach($request->getParameterBag()->get('products', []) as $product) {
                    $product['invoice'] = $invoice->getKey();
                    $this->getService(self::SERVICE_INVOICE_PRODUCT)->create(new ParameterBag($product));
                }

                return RedirectResponse::create(route('invoices.form', ['invoice_id' => $invoice->getKey()]));
            }

            /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $invoice */
            $invoice = $this->getService(self::SERVICE_INVOICE)->create($request->getParameterBag());

            return RedirectResponse::create(route('invoices.form', ['invoice_id' => $invoice->getKey()]));
        } catch (\Exception $exception) {
            return abort(500,
                sprintf("'%s' reported in '%s' on line %s", $exception->getMessage(), $exception->getFile(), $exception->getLine()));
        }
    }
}
