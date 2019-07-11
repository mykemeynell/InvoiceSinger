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
        {{-- Quote title & options --}}
        <div class="row margin-y-30">
            <div class="col s12 m6">
                <h4 class="margin-0">Quote #{{ $quote->getQuoteKey() }}</h4>
            </div>
            <div class="col s12 m6 input-field right-align">
                <!-- Dropdown Trigger -->
                <a class="options-dropdown-trigger btn-flat waves-effect waves-light margin-right-15" href="#"
                   data-target="options-dropdown">Options</a>

                <!-- Dropdown Structure -->
                <ul id='options-dropdown' class='dropdown-content'>
{{--                    <li><a href="{{ route('pdf.quote', $quote->getKey()) }}" target="_blank">Download as PDF</a>--}}
                    </li>
{{--                    <li><a href="{{ route('quotes.showPublic', $quote->getKey()) }}" target="_blank">View public--}}
{{--                            link</a></li>--}}
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#add-payment-modal" class="modal-trigger">Enter Payment</a></li>
                    @if(settings('email.provider') != 'none')
                    <li><a href="#!">Send via Email</a></li>
                    @endif
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="#!" class="red-text darken-1">Delete</a></li>
                </ul>

                <button form="client-form" id="save-form-button" formmethod="POST"
                        formaction="{{ route('quotes.handleForm', ['quote_id' => ! is_null($quote) ? $quote->getKey() : null]) }}"
                        class="waves-light waves-effect btn">Save
                </button>
            </div>
        </div>
        {{-- End quote title and options --}}

        {{-- Client info & quote details --}}
        <div class="row">
            <div class="col s6">
                <ul>
                    <li><h5>{{ $quote->client()->getDisplayName() }}</h5></li>
                    @foreach($client_service->getAddressObject($quote->client()) as $address_line)
                        @if(! empty($address_line))
                            <li>{{ $address_line }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-content">
                        {{-- Quote number & quote status --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="quote[key]" id="quote-key"
                                       value="{{ $quote->getQuoteKey() }}">
                                <label for="quote-key">Quote number</label>
                            </div>
                            <div class="col s6 input-field">
                                <select name="quote[status]" id="quote-status">
                                    <option value="draft"
                                            @if($quote->getStatus() == 'draft') selected="selected" @endif>Draft
                                    </option>
                                    <option value="sent"
                                            @if($quote->getStatus() == 'sent') selected="selected" @endif>Sent
                                    </option>
                                    <option value="viewed"
                                            @if($quote->getStatus() == 'viewed') selected="selected" @endif>Viewed
                                    </option>
                                    <option value="paid"
                                            @if($quote->getStatus() == 'paid') selected="selected" @endif>Paid
                                    </option>
                                    <option value="overdue"
                                            @if($quote->getStatus() == 'overdue') selected="selected" @endif>Overdue
                                    </option>
                                    <option value="cancelled"
                                            @if($quote->getStatus() == 'cancelled') selected="selected" @endif>
                                        Cancelled
                                    </option>
                                </select>
                                <label for="quote-status">Status</label>
                            </div>
                        </div>
                        {{-- End quote number & status --}}
                        {{-- Quote raised date & payment method --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="quote[raised_at]" class="datepicker" id="quote-raised-at"
                                       value="{{ $quote->getIssuedAt()->format('d F Y') }}">
                                <label for="quote-raised-at">Issued date</label>
                            </div>
                        </div>
                        {{-- End invoce raised date & payment method --}}
                        {{-- Quote due date & sent at --}}
                        <div class="row margin-bottom-0">
                            <div class="col s6 input-field">
                                <input type="text" name="quote[due_at]" class="datepicker" id="quote-due-at"
                                       value="{{ $quote->getExpiresAt()->format('d F Y') }}">
                                <label for="quote-due-at">Expiry date</label>
                            </div>
                            <div class="col s6 input-field">
                                <input type="text" name="quote[sent_at]" class="datepicker" id="quote-sent-at"
                                       value="{{ ! empty($quote->getSentAt()) ? $quote->getSentAt()->format('d F Y') : '' }}">
                                <label for="quote-sent-at">Sent at</label>
                            </div>
                        </div>
                        {{-- End invoce due date & sent at --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End client info & quote details --}}

        <hr>

        <product-table
                currency="{!! $currency !!}"
                :taxes="{{ $tax_rate_service->fetch() }}"
                :units="{{ $unit_service->fetch() }}"
                :products="{{ $quote->items() }}"></product-table>

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
