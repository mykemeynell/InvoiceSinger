@inject('client_service', \InvoiceSinger\Storage\Service\ClientService)

@extends('layouts.app', [
    'show_header' => false,
    'show_fab' => false,
    'show_progress' => false,
])

@section('body_classes', 'page-public-viewer')

@section('content')
    <div class="container">
        @if(settings('app.online_payments.enabled') == true)
        <div class="row margin-bottom-30 padding-top-15">
            <div class="card grey lighten-5">
                <div class="card-content">
                    <div class="row margin-0 valign-wrapper">
                        <div class="col s6">
                            <div class="card-title">You can pay here!</div>
                            <p>This invoice has online payments enabled - so you can clear balances even easier! Click
                                the "Pay Online" button to get started.</p>
                        </div>
                        <div class="col s6 right-align">
                            <form id="op-form" name="op-form">
                                {!! csrf_field() !!}
                                <input type="hidden" name="invoice[id]" value="{{ $invoice->getKey() }}">
                                <button form="op-form" formmethod="POST" formaction="{{ route('payment.handleCreate') }}" class="waves-effect waves-light green btn">Pay Online</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row padding-y-30">
            <div class="col s4">
                <img src="{{ asset(settings('app.logo')) }}" alt="Company Logo" class="brand-logo">
            </div>
            <div class="col s8">
                <h4 class="bold-text right-align">Invoice {{ $invoice->getInvoiceKey() }}</h4>
                <span class="display-block right-align grey-text lighten-2">issued {{ $invoice->getRaisedAt()->format('jS F Y') }}</span>
                <span class="display-block right-align grey-text lighten-2">payment due {{ $invoice->getDueAt()->format('jS F Y') }}</span>
            </div>
        </div>

        <hr class="margin-y-30">

        <div class="row padding-y-30">
            <div class="col s3">
                <span class="display-block grey-text lighten-2">FAO:</span>
                <ul>
                    @foreach($client_service->getAddressObject($invoice->client(), true) as $address_line)
                        @if(! empty($address_line))
                            <li>{{ $address_line }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col s3">
                <span class="display-block grey-text lighten-2">Sent from:</span>
                <ul>
                    @foreach($client_service->getAddressObject($invoice->client(), true) as $address_line)
                        @if(! empty($address_line))
                            <li>{{ $address_line }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            @if(! empty(settings('invoice.footer')))
            <div class="col s6">
                <span class="display-block grey-text lighten-2">Invoice Notes</span>
                {!! settings('invoice.footer') !!}
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col s12">
                <table>
                    <thead>
                    <tr>
                        <th width="50" class="center-align">#</th>
                        <th>Name</th>
                        <th width="150" class="right-align">Unit Price</th>
                        <th width="100" class="right-align">Quantity</th>
                        <th width="150" class="right-align">Subtotal</th>
                        <th width="150" class="right-align">Tax</th>
                        <th width="150" class="right-align">Discount</th>
                        <th width="150" class="right-align">Total</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($invoice->items() as $key => $item)
                        @php
                            /** @var \InvoiceSinger\Storage\Entity\InvoiceProductEntity $item */
                            $subtotal += $item->getSubtotal();
                            $tax += $item->getTaxPaid();
                            $discount += $item->getDiscount();
                            $total += $item->getTotal();
                        @endphp
                        <tr>
                            <td class="center-align grey lighten-4">{{ $key + 1 }}</td>
                            <td>
                                <span class="display-block bold-text">{{ $item->getDisplayName() }}</span>
                                <span class="display-block">{{ $item->getDescription() }}</span>
                            </td>
                            <td class="right-align">{!! $currency !!}{{ number_format($item->getPrice(), 2) }}</td>
                            <td class="right-align">{{ number_format($item->getQuantity(), 2) }}
                                <br>{{ $item->unit->getUnit() }}</td>
                            <td class="right-align">{!! $currency !!}{{ number_format($item->getSubtotal(), 2) }}</td>
                            <td class="right-align">
                                <span class="display-block">{!! $currency !!}{{ number_format($item->getTaxPaid(), 2) }}</span>
                                <span class="display-block">{{ $item->tax_rate->getDisplayName() }} ({{ $item->tax_rate->getAmount() }}%)</span>
                            </td>
                            <td class="right-align">{!! $currency !!}{{ number_format($item->getDiscount(), 2) }}</td>
                            <td class="right-align">{!! $currency !!}{{ number_format($item->getTotal(), 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="center-align">No items</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row padding-top-30">
            <div class="col s4 offset-s8">
                <table>
                    <tbody>
                    <tr>
                        <th width="150">Subtotal</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($subtotal, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Tax</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($tax, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Discount</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($discount, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($total, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Paid</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($paid, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Balance</th>
                        <td class="right-align">{!! $currency !!}{{ number_format($balance, 2) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
