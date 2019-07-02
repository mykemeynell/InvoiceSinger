@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row margin-y-30">
            <div class="col s6">
                <h4>Payments</h4>
            </div>
            <div class="col s6 right-align margin-top-15 margin-bottom-30">
                <a href="{{ route('payments.methods') }}" class="waves-effect waves-dark grey lighten-3 black-text btn">Payment Methods</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Payment Date</th>
                            <th>Invoice Date</th>
                            <th>Invoice</th>
                            <th>Client</th>
                            <th class="right-align">Amount</th>
                            <th>Payment Method</th>
                            <th>Note</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php /** @var \InvoiceSinger\Storage\Entity\PaymentEntity $payment */ @endphp
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->getPaidAt()->format('j F Y H:i:s') }}</td>
                        <td>{{ $payment->invoice()->getRaisedAt()->format('j F Y') }}</td>
                        <td><a href="#">{{ $payment->invoice()->getInvoiceKey() }}</a></td>
                        <td><a href="#">{{ $payment->invoice()->client()->getDisplayName() }}</a></td>
                        <td class="right-align">{!! $curerncy !!}{{ number_format($payment->getAmount(), 2) }}</td>
                        <td>{{ $payment->method()->getDisplayName() }}</td>
                        <td>{{ $payment->getNotes() }}</td>
                        <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="center-align">No Payments</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light">
        <i class="material-icons">add</i>
    </a>
@endpush
