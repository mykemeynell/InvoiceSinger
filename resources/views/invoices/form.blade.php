@inject('client_service', \InvoiceSinger\Storage\Service\ClientService)
@inject('unit_service', \InvoiceSinger\Storage\Service\UnitService)
@inject('tax_rate_service', \InvoiceSinger\Storage\Service\TaxRateService)
@inject('payment_method_service', \InvoiceSinger\Storage\Service\PaymentMethodService)

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
                <!-- Dropdown Trigger -->
                <a class="options-dropdown-trigger btn-flat waves-effect waves-light margin-right-15" href="#"
                   data-target="options-dropdown">Options</a>

                <!-- Dropdown Structure -->
                <ul id='options-dropdown' class='dropdown-content'>
                    <li><a href="{{ route('pdf.invoice', $invoice->getKey()) }}" target="_blank">Download as PDF</a>
                    </li>
                    <li><a href="{{ route('invoices.showPublic', $invoice->getKey()) }}" target="_blank">View public
                            link</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#add-payment-modal" class="modal-trigger">Enter Payment</a></li>
                    @if(settings('email.provider') != 'none')
                    <li><a href="#!">Send via Email</a></li>
                    @endif
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#!" class="red-text darken-1">Delete</a></li>
                </ul>

                <button form="client-form" id="save-form-button" formmethod="POST"
                        formaction="{{ route('invoices.handleForm', ['invoice_id' => ! is_null($invoice) ? $invoice->getKey() : null]) }}"
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
                                <select name="invoice[payment_method]" id="invoice-payment-method">
                                    @foreach($payment_method_service->fetch() as $payment_method)
                                        <option value="{{ $payment_method->getKey() }}"
                                                @if($payment_method->getKey() == $invoice->getPaymentMethod()) selected="selected" @endif>{{ $payment_method->getDisplayName() }}</option>
                                    @endforeach
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
                                <input type="text" name="invoice[sent_at]" class="datepicker" id="invoice-sent-at"
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

        <product-table
                currency="{!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}"
                :taxes="{{ $tax_rate_service->fetch() }}"
                :units="{{ $unit_service->fetch() }}"
                :products="{{ $invoice->items() }}"></product-table>

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

    <div id="add-payment-modal" class="modal">
        <div class="modal-content">
            <h4>Enter Payment</h4>
            <form class="padding-y-30" id="add-payment-form" name="add-payment-form">
                {!! csrf_field() !!}
                <div class="row margin-bottom-0">
                    <div class="col s12 input-field">
                        <select name="payment[method]" id="payment-method">
                            @foreach($payment_method_service->fetch() as $method)
                                <option value="{{ $method->getKey() }}">{{ $method->getDisplayName() }}</option>
                            @endforeach
                        </select>
                        <label for="payment-method">Method</label>
                    </div>
                </div>
                <div class="row margin-0">
                    <div class="col s12 input-field">
                        <span class="prefix">{!! $currency !!}</span>
                        <input type="number" min="0" max="{{ $invoice->getBalance() }}" step="0.01" id="payment-amount" name="payment[amount]" value="{{ number_format($invoice->getBalance(), 2) }}">
                        <label for="payment-amount">Amount</label>
                    </div>
                </div>
                <div class="row margin-0">
                    <div class="col s6 input-field">
                        <input type="text" class="datepicker" id="payment-date" name="payment[paid_at_hour]" value="{{ date('d F Y') }}">
                        <label for="payment-date">Date</label>
                    </div>
                    <div class="col s6 input-field">
                        <input type="text" class="timepicker" id="payment-time" name="payment[paid_at_time]" value="{{ date('h:m A') }}">
                        <label for="payment-time">Time</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button form="add-payment-form" formaction="{{ route('payments.handleForm', $invoice->getKey()) }}"
                    formmethod="POST" class="modal-close waves-effect waves-green btn-flat">Create
            </button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.modal').modal();
            $('.options-dropdown-trigger').dropdown({
                constrainWidth: false,
                alignment: 'right'
            });

            let search_field = $('#product-search-field');

            search_field.on('keyup', function (event) {
                event.preventDefault();
                let table_search = $('#product-search-table_filter input[type="search"]');

                table_search.val($(this).val());
                table_search.trigger('keyup');
            });
        });
    </script>
@endpush
