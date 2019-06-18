<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** @var \Illuminate\Routing\Router $router */
$router = app('router');

$router->get('/', function(){ return view('dashboard'); });
$router->get('/clients', function(){ return view('clients'); });
$router->get('/quotes', function(){ return view('quotes'); });
$router->get('/invoices', function(){ return view('invoices'); });
