<?php

namespace InvoiceSinger\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class PaymentController
 *
 * @package InvoiceSinger\Http\Controllers\Payments
 */
class PaymentController extends Controller
{
    use HasService;

    /**
     * PaymentController constructor.
     */
    function __construct()
    {
    }

    /**
     * Display list view for payments.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('payments');
    }
}
