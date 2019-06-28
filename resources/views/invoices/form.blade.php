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
                    <tr>
                        <td>
                            <input type="text" value="" placeholder="Name" name="">
                            <textarea class="materialize-textarea" placeholder="Description" name=""></textarea>
                        </td>
                        <td class="right-align">
                            <div class="input-field">
                                <input type="text" value="0.00" class="right-align" name="">
                            </div>
                        </td>
                        <td class="right-align">
                            <input type="text" value="1" class="right-align" name="">
                            <select>
                                <option value="">Unit</option>
                            </select>
                        </td>
                        <td class="right-align">
                            £<span class="invoice-product-subtotal">0.00</span>
                        </td>
                        <td class="right-align">
                            <input type="text" value="0" class="right-align" name="">
                        </td>
                        <td class="right-align">
                            <select>
                                <option value="">Tax</option>
                            </select>
                        </td>
                        <td class="right-align">
                            £0.00
                        </td>
                    </tr>
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
                        <td class="right-align">
                            {!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}<span id="invoice-totals-subtotal">0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td class="right-align">20%</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td class="right-align">
                            {!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}<span id="invoice-totals-discount">0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="right-align">
                            {!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}<span id="invoice-totals-total">0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Paid</th>
                        <td class="right-align">
                            {!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}<span id="invoice-totals-paid">0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="bold-text">Balance</span></th>
                        <td class="right-align">
                            {!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}<span id="invoice-totals-balance">0.00</span>
                        </td>
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
                        <tbody>
                        </tbody>
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

            search_field.on('keyup', function(event) {
                event.preventDefault();
                let table_search = $('#product-search-table_filter input[type="search"]');

                table_search.val($(this).val());
                table_search.trigger('keyup');
            });
        });
    </script>
@endpush
