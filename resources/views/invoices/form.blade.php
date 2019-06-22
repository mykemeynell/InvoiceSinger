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
            <div class="col s12 m6 right-align">
                <button form="client-form" formmethod="POST" formaction="{{ route('clients.handleForm') }}"
                        class="waves-light waves-effect btn margin-right-15">Save
                </button>
                <a href="{{ route('clients') }}" class="waves-light waves-effect btn red darken-1">Discard</a>
            </div>
        </div>
        {{-- End invoice title and options --}}

        {{-- Client info & invoice details --}}
        <div class="row">
            <div class="col s6">
                <ul>
                    <li><h5>{{ $invoice->client()->getDisplayName() }}</h5></li>
                    @foreach($invoice->client()->getAddressObject() as $address_line)
                        <li>{{ $address_line }}</li>
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
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="right-align">Price</th>
                            <th class="right-align">Quantity</th>
                            <th class="right-align">Subtotal</th>
                            <th class="right-align">Discount</th>
                            <th class="right-align">Tax Rate</th>
                            <th class="right-align">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="display-block bold-text">Example item</span>
                            This is the example item
                        </td>
                        <td class="right-align">&pound;9.99</td>
                        <td class="right-align">1 Unit</td>
                        <td class="right-align">&pound;9.99</td>
                        <td class="right-align">0%</td>
                        <td class="right-align">20%</td>
                        <td class="right-align">&pound;11.99</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </form>

@endsection
