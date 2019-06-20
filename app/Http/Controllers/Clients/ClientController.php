<?php

namespace InvoiceSinger\Http\Controllers\Clients;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Http\Requests\Client\ClientRequest;

/**
 * Class ClientController.
 *
 * @package InvoiceSinger\Http\Controllers\CLients
 */
class ClientController extends Controller
{
    /**
     * Return clients view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('clients');
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
     */
    public function handlePost(ClientRequest $request): RedirectResponse
    {

    }
}
