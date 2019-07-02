@inject('client_service', \InvoiceSinger\Storage\Service\ClientService)

@extends('layouts.pdf', [
    'show_header' => false,
    'show_fab' => false,
    'show_progress' => false,
])

@section('body_classes', 'page-pdf')

@section('content')

    <div class="row">
        <div class="col one-third-wide">
            Logo
        </div>
        <div class="col two-thirds-wide">
            <h1 class="bold-text right-align padding-bottom-15">Invoice {{ $invoice->getInvoiceKey() }}</h1>
            <span class="right-align display-block subtle-text">issued {{ $invoice->getRaisedAt()->format('jS F Y') }}</span>
            <span class="right-align display-block subtle-text">payment due {{ $invoice->getDueAt()->format('jS F Y') }}</span>
        </div>
    </div>

    <div class="row">
        <hr>
    </div>

    <div class="row">
        <div class="col one-half-wide">
            <span class="display-block subtle-text">FAO:</span>
            <ul>
                @foreach($client_service->getAddressObject($invoice->client(), true) as $address_line)
                    @if(! empty($address_line))
                        <li>{{ $address_line }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="col one-half-wide right-align">
            <span class="display-block subtle-text">Sent from:</span>
            <ul>
                @foreach($client_service->getAddressObject($invoice->client(), true) as $address_line)
                    @if(! empty($address_line))
                        <li>{{ $address_line }}</li>
                    @endif
                @endforeach
            </ul>
        </div>


        <div class="row">
            <hr>
        </div>

        <div class="row">
            <div class="col full-wide">
                <table>
                    <thead>
                    <tr>
                        <th width="20" class="center-align">#</th>
                        <th>Name</th>
                        <th width="50" class="right-align">Unit Price</th>
                        <th width="50"  class="right-align">Quantity</th>
                        <th width="50" class="right-align">Subtotal</th>
                        <th width="50" class="right-align">Tax</th>
                        <th width="50" class="right-align">Discount</th>
                        <th width="50" class="right-align">Total</th>
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
                            <td class="right-align">{{ number_format($item->getQuantity(), 2) }}<br>{{ $item->unit->getUnit() }}</td>
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

        <div class="row">
            <div class="col one-half-wide"></div>
            <div class="col one-half-wide">
                <table class="margin-left-auto">
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
