<?php

namespace InvoiceSinger\Http\Controllers\Clients;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Client\ClientRequest;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class ClientController.
 *
 * @method ClientServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\CLients
 */
class ClientController extends Controller
{
    use HasService;

    /**
     * ClientController constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\ClientServiceInterface $service
     */
    function __construct(ClientServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Return clients view.
     *
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function index(): View
    {
        $clients = $this->getService()->fetch();

        return view('clients', compact('clients'));
    }

    /**
     * Show the clients form view.
     *
     * @return \Illuminate\View\View
     */
    public function form(): View
    {
        return view('clients.form');
    }

    /**
     * Handle a post request for a client.
     *
     * @param \InvoiceSinger\Http\Requests\Client\ClientRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function handlePost(ClientRequest $request): RedirectResponse
    {
        try {
            if ($client = $request->client()) {
                $this->getService()->update($client, $request->getParameterBag());

                return RedirectResponse::create(route('clients'), 200);
            }

            $this->getService()->create($request->getParameterBag());

            return RedirectResponse::create(route('clients'), 201);
        } catch (\Exception $exception) {

            dd($exception);

        }
    }
}
