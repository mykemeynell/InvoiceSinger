<?php

namespace InvoiceSinger\Http\Controllers\Quotes;

use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\QuoteServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class QuoteController.
 *
 * @method QuoteServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Quotes
 */
class QuoteController extends Controller
{
    use HasService;

    /**
     * QuoteController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\QuoteServiceInterface|\ArchLayer\Service\Service $service
     */
    function __construct(QuoteServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Show the index quote view.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('quotes')
            ->with('quotes', $this->getService()->fetch());
    }
}
