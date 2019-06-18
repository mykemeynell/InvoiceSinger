<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$options = ['middleware' => ['api', 'auth:api']];

/** @var \Illuminate\Routing\Router $router */
$router = app('router');

$router->get('/timestamp', 'Api\TestController@timestamp');
$router->get('/', 'Api\TestController@index');

$router->group($options, function() use ($router) {
    $router->get('/user', function(Request $request) { return $request->user(); });
});
