@inject('client_service', \InvoiceSinger\Storage\Service\ClientService)
@inject('unit_service', \InvoiceSinger\Storage\Service\UnitService)
@inject('tax_rate_service', \InvoiceSinger\Storage\Service\TaxRateService)

@extends('layouts.app')

@section('content')

    {{-- Form action buttons --}}

    {{-- End form action buttons --}}

    <form id="client-form" name="client-form">
        {!! csrf_field() !!}
        {{-- Invoice title & options --}}
        <div class="row margin-y-30">
            <div class="col s12 m6">
                <h4 class="margin-0">Invoice #{{ $invoice->getInvoiceKey() }}</h4>
            </div>
            <div class="col s12 m6 input-field right-align">
                <a href="#" data-target="#options-dropdown" class="waves-light waves-effect btn margin-right-15">Options</a>
                <button form="client-form" formmethod="POST" formaction="{{ route('clients.handleForm') }}"
                        class="waves-light waves-effect btn">Save
                </button>
            </div>
        </div>
        {{-- End invoice title and options --}}

        {{-- Client info & invoice details --}}
        <div class="row">
            <div class="col s6">
                <ul>
                    <li><h5>{{ $invoice->client()->getDisplayName() }}</h5></li>
                    @foreach($client_service->getAddressObject($invoice->client()) as $address_line)
                        @if(! empty($address_line))
                        <li>{{ $address_line }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        {{-- Invoice number & invoice status --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="invoice[key]" id="invoice-key"
                                       value="{{ $invoice->getInvoiceKey() }}">
                                <label for="invoice-key">Invoice number</label>
                            </div>
                            <div class="col s6 input-field">
                                <select name="invoice[status]" id="invoice-status">
                                    <option value="draft"
                                            @if($invoice->getStatus() == 'draft') selected="selected" @endif>Draft
                                    </option>
                                    <option value="sent"
                                            @if($invoice->getStatus() == 'sent') selected="selected" @endif>Sent
                                    </option>
                                    <option value="viewed"
                                            @if($invoice->getStatus() == 'viewed') selected="selected" @endif>Viewed
                                    </option>
                                    <option value="paid"
                                            @if($invoice->getStatus() == 'paid') selected="selected" @endif>Paid
                                    </option>
                                    <option value="overdue"
                                            @if($invoice->getStatus() == 'overdue') selected="selected" @endif>Overdue
                                    </option>
                                    <option value="cancelled"
                                            @if($invoice->getStatus() == 'cancelled') selected="selected" @endif>
                                        Cancelled
                                    </option>
                                </select>
                                <label for="invoice-status">Status</label>
                            </div>
                        </div>
                        {{-- End invoice number & status --}}
                        {{-- Invoice raised date & payment method --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="invoice[raised_at]" class="datepicker" id="invoice-raised-at"
                                       value="{{ $invoice->getRaisedAt()->format('d F Y') }}">
                                <label for="invoice-raised-at">Raised date</label>
                            </div>
                            <div class="col s6 input-field">
                                <select name="invoice[status]" id="invoice-payment-method">
                                    <option value="payment">Payment</option>
                                </select>
                                <label for="invoice-payment-method">Payment method</label>
                            </div>
                        </div>
                        {{-- End invoce raised date & payment method --}}
                        {{-- Invoice due date & sent at --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="invoice[due_at]" class="datepicker" id="invoice-due-at"
                                       value="{{ $invoice->getDueAt()->format('d F Y') }}">
                                <label for="invoice-due-at">Due date</label>
                            </div>
                            <div class="col s6 input-field">
                                <input type="text" name="invoice[due_at]" class="datepicker" id="invoice-sent-at"
                                       value="{{ ! empty($invoice->getSentAt()) ? $invoice->getSentAt()->format('d F Y') : '' }}">
                                <label for="invoice-sent-at">Sent at</label>
                            </div>
                        </div>
                        {{-- End invoce due date & sent at --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End client info & invoice details --}}

        <hr>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table" id="invoice-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="right-align" width="150">Price</th>
                            <th class="right-align" width="250">Quantity</th>
                            <th class="right-align" width="150">Subtotal</th>
                            <th class="right-align" width="150">Discount</th>
                            <th class="right-align" width="250">Tax Rate</th>
                            <th class="right-align" width="150">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col s9">
                <a href="#" class="waves-effect waves-dark btn-flat margin-right-15">Add Item</a>
                <a href="#add-product-modal" class="waves-effect waves-dark btn-flat modal-trigger">Add Product</a>
            </div>

            <div class="col s3">
                <table class="responsive-table">
                    <tr>
                        <th>Subtotal</th>
                        <td class="right-align">&pound;0.00</td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td class="right-align">20%</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td class="right-align">&pound;0.00</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="right-align">&pound;0.00</td>
                    </tr>
                    <tr>
                        <th>Paid</th>
                        <td class="right-align">&pound;0.00</td>
                    </tr>
                    <tr>
                        <th><span class="bold-text">Balance</span></th>
                        <td class="right-align">&pound;0.00</td>
                    </tr>
                </table>
            </div>
        </div>

    </form>

@endsection

@push('end')
    <div id="add-product-modal" class="modal">
        <div class="modal-content">
            <h4>Add Product</h4>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">search</i>
                    <input type="text" class="autocomplete" id="product-search-field">
                    <label for="product-search-field">Search</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <table class="responsive-table" id="product-search-table">
                        <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Family</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th class="right-align">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();

            let makeId = function (length) {
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for ( var i = 0; i < length; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            };

            let search_field = $('#product-search-field');
            let results_table = $('#product-search-table');

            let table = results_table.DataTable({
                ajax: {
                    url: '/api/products',
                    dataSrc: ''
                },
                columns: [
                    {data: 'sku'},
                    {data: 'family.name'},
                    {data: 'name'},
                    {data: 'unit.name'},
                    {data: 'price'}
                ],
                columnDefs: [{
                    targets: 5,
                    data: null,
                    defaultContent: "<a href='#' class='js-add-product waves-effect waves-light btn-flat grey lighten-4'>Add</a>",
                    className: "right-align"
                }]
            });

            $('#product-search-table tbody').on( 'click', '.js-add-product', function (event) {
                event.preventDefault();

                let item = table.row($(this).parents('tr')).data();
                let id = makeId(64);

                console.log("Product: ", item);

                let html = '<tr>\n' +
                    '                        <td>\n' +
                    '                            <input type="text" value="' + item.name + '" placeholder="Name" name="invoice[products][' + id + '][name]">\n' +
                    '                            <textarea class="materialize-textarea" placeholder="Description" name="invoice[products][' + id + '][description]">' + item.description + '</textarea>\n' +
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            <div class="input-field">\n' +
                    '                                <input type="text" value="' + item.price + '" class="right-align invoice-product-' + id + '-price" name="invoice[products][' + id + '][price]">\n' +
                    '                            </div>\n' +
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            <input type="text" value="1" class="right-align invoice-product-' + id + '-quantity" name="invoice[products][' + id + '][quantity]">\n' +
                    '                            <select name="invoice[products][' + id + '][unit]" class="invoice-product-' + id + '-select">\n' +
                    @foreach($unit_service->fetch() as $unit)
                    '                                <option value="{{ $unit->getKey() }}">{{ $unit->getDisplayName() }}</option>\n' +
                    @endforeach
                    '                            </select>\n' +
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            &pound;<span class="invoice-product-' + id + '-subtotal">' + item.price + '</span>\n' +
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            <input type="text" value="0" class="right-align invoice-product-' + id + '-discount" name="invoice[products][' + id + '][discount]">\n' +
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            <select name="invoice[products][' + id + '][tax_rate]" class="invoice-product-' + id + '-select invoice-product-' + id + '-tax">\n' +
                    '                                <option value="">No Tax (0%)</option>\n' +
                    @foreach($tax_rate_service->fetch() as $tax_rate)
                    '                                <option value="{{ $tax_rate->getKey() }}">{{ $tax_rate->getDisplayName() }} ({{ $tax_rate->getAmount() }}%)</option>\n' +
                    @endforeach
                    '                            </select>\n' +
                    @foreach($tax_rate_service->fetch() as $tax_rate)
                    '                            <input type="hidden" class="invoice-hidden-tax-rate-" value="1">\n' +
                    '                            <input type="hidden" class="invoice-hidden-tax-rate-{{ $tax_rate->getKey() }}" value="{{ $tax_rate->getMultiplier() }}">\n' +
                    @endforeach
                    '                        </td>\n' +
                    '                        <td class="right-align">\n' +
                    '                            &pound;<span class="invoice-product-' + id + '-total">' + item.price + '</span>\n' +
                    '                        </td>\n' +
                    '                    </tr>';

                $('#invoice-table tbody').append(html);
                $('.invoice-product-' + id + '-select').formSelect();

                let product = {
                    'price': $('.invoice-product-' + id + '-price'),
                    'quantity': $('.invoice-product-' + id + '-quantity'),
                    'subtotal': $('.invoice-product-' + id + '-subtotal'),
                    'discount': $('.invoice-product-' + id + '-discount'),
                    'tax': $('.invoice-product-' + id + '-tax'),
                    'total': $('.invoice-product-' + id + '-total')
                };

                // Handle price change of product in invoice table.
                $('body').on('keyup', product.price, function(event) {
                    event.preventDefault();
                    product.subtotal.html(calculateSubtotal(product.price.val(), product.quantity.val()))
                });

                // Handle quantity change of product in invoice table.
                $('body').on('keyup', product.quantity, function(event) {
                    event.preventDefault();
                    product.subtotal.html(calculateSubtotal(product.price.val(), product.quantity.val()));

                    let tax_id = $('.invoice-product-' + id + '-tax').val(),
                        multiplier = $('.invoice-hidden-tax-rate-' + tax_id).val();
                    product.total.text(calculateTotal(product.subtotal.text(), product.discount.val(), multiplier));
                });

                $('body').on('change', product.tax, function(event) {
                    event.preventDefault();
                    let tax_id = $('.invoice-product-' + id + '-tax').val(),
                        multiplier = $('.invoice-hidden-tax-rate-' + tax_id).val();
                    product.total.text(calculateTotal(product.subtotal.text(), product.discount.val(), multiplier));
                });
            } );

            let calculateSubtotal = function(price, quantity) {
                return parseFloat(price) * parseFloat(quantity);
            };

            let calculateTotal = function(subtotal, discount, multiplier) {
                console.log('Subtotal: ', subtotal);
                console.log('Discount: ', discount);
                console.log('Multiplier: ', multiplier);

                return ((subtotal * multiplier) - discount).toFixed(2);
            };

            search_field.on('keyup', function(event) {
                event.preventDefault();
                let table_search = $('#product-search-table_filter input[type="search"]');

                table_search.val($(this).val());
                table_search.trigger('keyup');
            });
        });
    </script>
@endpush
