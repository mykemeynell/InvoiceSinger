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

$router->get('/', function(){ return view('dashboard'); })->name('dashboard');
$router->get('/clients', function(){ return view('clients'); })->name('clients');
$router->get('/quotes', function(){ return view('quotes'); })->name('quotes');
$router->get('/invoices', function(){ return view('invoices'); })->name('invoices');
$router->get('/payments', function(){ return view('payments'); })->name('payments');
$router->get('/products', function(){ return view('products'); })->name('products');

/*
 * Authentication routes.
 */
$router->get('/login', function(){ return view('login'); })->name('login');
