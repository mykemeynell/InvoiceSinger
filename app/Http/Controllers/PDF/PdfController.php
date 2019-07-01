<?php

namespace InvoiceSinger\Http\Controllers\PDF;

use Illuminate\Http\Request;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Invoice\InvoiceRequest;
use mykemeynell\Support\CurrencyHtmlEntities;

/**
 * Class PdfController.
 *
 * @package InvoiceSinger\Http\Controllers\PDF
 */
class PdfController extends Controller
{
    public function invoice(InvoiceRequest $request)
    {
        /** @var CurrencyHtmlEntities $che */
        $che = app()->make(CurrencyHtmlEntities::class);

        return view('pdf.invoice')
            ->with('invoice', $request->invoice())
            ->with('currency', $che->entity(settings('app.currency')))
            ->with('subtotal', 0)
            ->with('tax', 0)
            ->with('discount', 0)
            ->with('total', 0)
            ->with('paid', 0)
            ->with('balance', 0);
    }
}
