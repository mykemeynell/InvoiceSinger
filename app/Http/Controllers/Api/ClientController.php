<?php

namespace InvoiceSinger\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use InvoiceSinger\Http\Controllers\Controller;
use InvoiceSinger\Storage\Service\Contract\ClientServiceInterface;
use InvoiceSinger\Support\Concern\HasService;

/**
 * Class ClientController.
 *
 * @method ClientServiceInterface getService(?string $name = null) : ServiceInterface
 *
 * @package InvoiceSinger\Http\Controllers\Api
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
     * Fetch all clients.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function fetch(): JsonResponse
    {
        return JsonResponse::create($this->getService()->fetch(), 200);
    }
}
