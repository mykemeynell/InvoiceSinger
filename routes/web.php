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
$router->post('/clients/delete/{client_id?}', 'Clients\ClientController@handleDelete')->name('clients.handleDelete');

// Quotes
$router->get('/quotes', 'Quotes\QuoteController@index')->name('quotes');
$router->get('/quotes/form/{quote_id?}', 'Quotes\QuoteController@form')->name('quotes.form');
$router->post('/quotes/form/{quote_id?}', 'Quotes\QuoteController@handlePost')->name('quotes.handleForm');

// Invoices
$router->get('/invoices', 'Invoices\InvoiceController@index')->name('invoices');
$router->get('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@form')->name('invoices.form');
$router->post('/invoices/form/{invoice_id?}', 'Invoices\InvoiceController@handlePost')->name('invoices.handleForm');

// Public Invoice View
$router->get('/invoices/public/{invoice_id?}', 'Invoices\InvoiceController@viewPublic')->name('invoices.showPublic');

// Online Payments
$router->post('/invoices/public/payment/create', 'OnlinePayments\OnlinePaymentController@handlePost')->name('payment.handleCreate');
$router->get('/invoices/public/payment/success', 'OnlinePayments\OnlinePaymentController@showPaymentSuccess')->name('payment.success');
$router->get('/invoices/public/payment/error', 'OnlinePayments\OnlinePaymentController@showPaymentError')->name('payment.error');

// Online Payment Hook Endpoints
$router->post('/webhook/payment/success', 'OnlinePayments\OnlinePaymentController@handleSuccessWebhook')->name('webhook.payment.success');
$router->post('/webhook/payment/error', 'OnlinePayments\OnlinePaymentController@handleErrorWebhook')->name('webhook.payment.error');

// Payments
$router->get('/payments', 'Payments\PaymentController@index')->name('payments');
$router->post('/payments/{invoice_id}', 'Payments\PaymentController@handlePost')->name('payments.handleForm');
$router->get('/payments/payment-methods', 'Payments\PaymentMethodController@index')->name('payments.methods');

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

// PDFs
$router->get('/pdf/invoice/{invoice_id}', 'PDF\PdfController@invoice')->name('pdf.invoice');

// Settings
$router->get('/settings', 'Settings\SettingController@index')->name('settings');
$router->post('/settings', 'Settings\SettingController@handlePost')->name('settings.handleForm');

/*
 * Authentication routes.
 */
$router->get('/login', static function () {
    return view('login');
})->name('login');
