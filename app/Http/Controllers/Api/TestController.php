<?php

namespace InvoiceSinger\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use InvoiceSinger\Http\Controllers\Controller;

/**
 * Class TestController
 *
 * @package InvoiceSinger\Http\Controllers\Api
 */
class TestController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'No request endpoints exist at this request URI',
            'success' => false,
        ], 404);
    }

    /**
     * Send back a test response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function timestamp(): JsonResponse
    {
        return response()->json([
            'message' => 'Current server time',
            'success' => true,
            'data' => [
                'timestamp' => time(),
            ],
        ]);
    }
}
