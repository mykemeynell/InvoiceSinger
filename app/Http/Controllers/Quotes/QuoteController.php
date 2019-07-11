<?php

namespace InvoiceSinger\Http\Controllers\Quotes;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Quote\QuoteRequest;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Storage\Service\Contract\QuoteProductServiceInterface;
use InvoiceSinger\Storage\Service\Contract\QuoteServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use mykemeynell\Support\CurrencyHtmlEntities;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class QuoteController.
 *
 * @package InvoiceSinger\Http\Controllers\Quotes
 */
class QuoteController extends Controller
{
    use HasService;

    public const SERVICE_QUOTE = 'quotes';
    public const SERVICE_QUOTE_PRODUCT = 'quoteProducts';
    public const SERVICE_CLIENT = 'clients';

    /**
     * QuoteController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\QuoteServiceInterface $quoteService
     * @param \InvoiceSinger\Storage\Service\Contract\QuoteProductServiceInterface $quoteProductService
     * @param \InvoiceSinger\Storage\Service\Contract\ClientServiceInterface $clientService
     */
    function __construct(
        QuoteServiceInterface $quoteService,
        QuoteProductServiceInterface $quoteProductService,
        ClientServiceInterface $clientService
    ) {
        $this->setService($quoteService, self::SERVICE_QUOTE);
        $this->setService($quoteProductService, self::SERVICE_QUOTE_PRODUCT);
        $this->setService($clientService, self::SERVICE_CLIENT);
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
        /** @var \mykemeynell\Support\CurrencyHtmlEntities $che */
        $che = app()->make(CurrencyHtmlEntities::class);

        return view('quotes')
            ->with('currency', $che->entity(settings('app.currency')))
            ->with('today', Carbon::today()->format('d F Y'))
            ->with('due',
                Carbon::today()->add(settings('quote.term'))->format('d F Y'))
            ->with('clients', $this->getService(self::SERVICE_CLIENT)->fetch())
            ->with('quotes', $this->getService(self::SERVICE_QUOTE)->fetch());
    }

    /**
     * Show the quote form.
     *
     * @param \InvoiceSinger\Http\Requests\Quote\QuoteRequest $request
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     */
    public function form(QuoteRequest $request): View
    {
        /** @var \mykemeynell\Support\CurrencyHtmlEntities $che */
        $che = app()->make(CurrencyHtmlEntities::class);

        return view('quotes.form')
            ->with('currency', $che->entity(settings('app.currency')))
            ->with('quote', $request->quote());
    }

    /**
     * Handle a quote post request.
     *
     * @param \InvoiceSinger\Http\Requests\Quote\QuoteRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function handlePost(QuoteRequest $request)
    {
        try {
            /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $quote */
            if ($quote = $request->quote()) {
                $this->getService(self::SERVICE_QUOTE)->update($quote,
                    $request->getParameterBag());

                $this->getService(self::SERVICE_QUOTE_PRODUCT)->removeUsingQuoteId($quote->getKey());
                foreach ($request->getParameterBag()->get('products',
                    []) as $product) {
                    $product['quote'] = $quote->getKey();
                    $this->getService(self::SERVICE_QUOTE_PRODUCT)->create(new ParameterBag($product));
                }

                return RedirectResponse::create(route('quotes.form',
                    ['quote_id' => $quote->getKey()]));
            }

            /** @var \InvoiceSinger\Storage\Entity\InvoiceEntity $quote */
            $quote = $this->getService(self::SERVICE_QUOTE)->create($request->getParameterBag());

            return RedirectResponse::create(route('quotes.form',
                ['quote_id' => $quote->getKey()]));
        } catch (\Exception $exception) {
            return abort(500,
                sprintf("'%s' reported in '%s' on line %s",
                    $exception->getMessage(), $exception->getFile(),
                    $exception->getLine()));
        }
    }
}
