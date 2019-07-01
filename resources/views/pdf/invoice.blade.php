@inject('client_service', \InvoiceSinger\Storage\Service\ClientService)

@extends('layouts.app', [
    'show_header' => false,
    'show_fab' => false,
    'show_progress' => false,
])

@section('body_classes', 'page-pdf')

@section('content')

    <div class="container">

        <div class="row padding-bottom-30">
            <div class="col s8">
                LOGO
            </div>
            <div class="col s4">
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

            <div class="col s6">
                <span class="display-block grey-text lighten-2">Invoice Description</span>
                <p>Sed posuere consectetur est at lobortis. Donec id elit non mi porta gravida at eget metus. Nullam
                    quis risus eget urna mollis ornare vel eu leo. Curabitur blandit tempus porttitor. Duis mollis, est
                    non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam quis risus
                    eget urna mollis ornare vel eu leo.</p>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th width="50" class="center-align">#</th>
                            <th>Name</th>
                            <th width="150" class="right-align">Unit Price</th>
                            <th width="100"  class="right-align">Quantity</th>
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
