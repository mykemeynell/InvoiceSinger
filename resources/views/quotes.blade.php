@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s12">
                <h4 class="margin-0">Quotes</h4>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Quote</th>
                            <th>Issued</th>
                            <th>Expires</th>
                            <th>Client</th>
                            <th class="right-align">Amount</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($quotes as $quote)
                    <tr>
                        <td>@include('layouts.components.misc._status-badge', ['item' => $quote])</td>
                        <td><a href="{{ route('quotes.form', $quote->getKey()) }}">{{ $quote->getQuoteKey() }}</a></td>
                        <td>{{ $quote->getIssuedAt()->format('d F Y') }}</td>
                        <td>{{ $quote->getExpiresAt()->format('d F Y') }}</td>
                        <td><a href="#">{{ $quote->client()->getEmailAddress()  }}</a></td>
                        <td class="right-align">{!! $currency !!}{{ $quote->getTotal() }}</td>
                        <td class="right-align"><a href="{{ route('quotes.form', $quote->getKey()) }}" class="waves-effect waves-light btn">View</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="center-align">No Quotes</td>
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
