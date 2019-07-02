<?php

namespace InvoiceSinger\Http\Controllers\PDF;

use Barryvdh\DomPDF\PDF;
use Dompdf\Css\Stylesheet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $invoice = $request->invoice();
        $currency = $che->entity(settings('app.currency'));
        $subtotal = 0;
        $tax = 0;
        $discount = 0;
        $total = 0;
        $paid = 0;
        $balance = 0;

        /** @var \Barryvdh\DomPDF\PDF $pdf */
        $pdf = app()->make(PDF::class);
        $pdf->getDomPDF()->setPaper('A4', 'portrait');
        $pdf->loadView('pdf.invoice', compact('invoice', 'currency', 'subtotal', 'tax', 'discount', 'total', 'paid', 'balance'));

        if($request->get('output', 'pdf') == 'pdf') {
            return Response::create($pdf->output())->header('Content-type', 'application/pdf');
        } else {
            return view('pdf.invoice', compact('invoice', 'currency', 'subtotal', 'tax', 'discount', 'total', 'paid', 'balance'));
        }
    }
}
