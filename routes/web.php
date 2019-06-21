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

// Dashbaord
$router->get('/', function(){ return view('dashboard'); })->name('dashboard');

// Clients
$router->get('/clients', 'Clients\ClientController@index')->name('clients');
$router->get('/clients/form/{client_id?}', 'Clients\ClientController@form')->name('clients.form');
$router->post('/clients/form/{client_id?}', 'Clients\ClientController@handlePost')->name('clients.handleForm');

// Quotes
$router->get('/quotes', function(){ return view('quotes'); })->name('quotes');

// Invoices
$router->get('/invoices', 'Invoices\InvoiceController@index')->name('invoices');
$router->get('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@form')->name('invoices.form');
$router->post('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@handlePost')->name('invoices.handleForm');

// Payments
$router->get('/payments', function(){ return view('payments'); })->name('payments');

// Products
$router->get('/products', function(){ return view('products'); })->name('products');

/*
 * Authentication routes.
 */
$router->get('/login', function(){ return view('login'); })->name('login');
