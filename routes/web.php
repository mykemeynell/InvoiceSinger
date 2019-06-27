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
$router->get('/', static function () {
    return view('dashboard');
})->name('dashboard');

// Clients
$router->get('/clients', 'Clients\ClientController@index')->name('clients');
$router->get('/clients/form/{client_id?}', 'Clients\ClientController@form')->name('clients.form');
$router->post('/clients/form/{client_id?}', 'Clients\ClientController@handlePost')->name('clients.handleForm');

// Quotes
$router->get('/quotes', static function () {
    return view('quotes');
})->name('quotes');

// Invoices
$router->get('/invoices', 'Invoices\InvoiceController@index')->name('invoices');
$router->get('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@form')->name('invoices.form');
$router->post('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@handlePost')->name('invoices.handleForm');

// Payments
$router->get('/payments', static function () {
    return view('payments');
})->name('payments');

// Products
$router->get('/products', 'Products\ProductController@index')->name('products');
$router->get('/products/form/{product_id?}', 'Products\ProductController@form')->name('products.form');
$router->post('/products/form/{product_id?}', 'Products\ProductController@handlePost')->name('products.handleForm');
$router->post('/products/delete/{product_id?}', 'Products\ProductController@handleDelete')->name('products.handleDelete');

$router->get('/products/families', 'Products\FamilyController@index')->name('products.families');
$router->get('/products/families/form/{family_id?}', 'Products\FamilyController@form')->name('products.families.form');
$router->post('/products/families/form/{family_id?}', 'Products\FamilyController@handlePost')->name('products.families.handleForm');
$router->post('/products/families/delete/{family_id?}', 'Products\FamilyController@handleDelete')->name('products.families.handleDelete');

$router->get('/products/units', 'Products\UnitController@index')->name('products.units');
$router->get('/products/units/form/{unit_id?}', 'Products\UnitController@form')->name('products.units.form');
$router->post('/products/units/form/{unit_id?}', 'Products\UnitController@handlePost')->name('products.units.handleForm');
$router->post('/products/units/delete/{unit_id?}', 'Products\UnitController@handleDelete')->name('products.units.handleDelete');

$router->get('/products/tax-rates', 'Products\TaxRateController@index')->name('products.taxRates');
$router->get('/products/tax-rates/form/{tax_rate_id?}', 'Products\TaxRateController@form')->name('products.taxRates.form');
$router->post('/products/tax-rates/form/{tax_rate_id?}', 'Products\TaxRateController@handlePost')->name('products.taxRates.handleForm');
$router->post('/products/tax-rates/delete/{tax_rate_id?}', 'Products\TaxRateController@handleDelete')->name('products.taxRates.handleDelete');

/*
 * Authentication routes.
 */
$router->get('/login', static function () {
    return view('login');
})->name('login');
