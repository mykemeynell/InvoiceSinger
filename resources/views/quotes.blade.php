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
                        <td><a href="{{ route('clients.form', $quote->client()->getKey()) }}">{{ $quote->client()->getDisplayName()  }}</a></td>
                        <td class="right-align">{!! $currency !!}{{ number_format($quote->getTotal(), 2) }}</td>
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

@push('end')
    <div id="new-quote-modal" class="modal">
        <div class="modal-content">
            <h4>Create New Quote</h4>
            <form name="new-quote-form" id="new-quote-form">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="input-field col s12">
                        @if($clients->count() > 0)
                            <select name="quote[client]" id="client-name" class="validate" required="required">
                                <option disabled selected>Select a client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->getKey() }}">{{ $client->getDisplayName() }}</option>
                                @endforeach
                            </select>
                            <label for="client-name">Client</label>
                        @else
                            <span>No clients - <a href="{{ route('clients.form') }}">Create one</a></span>
                        @endif
                    </div>
                </div>
                <div class="row @if($clients->count() == 0) display-none @endif">
                    <div class="input-field col s6">
                        <input id="raised-date" type="text" name="quote[issued_at]" class="datepicker validate" value="{{ $today }}" required>
                        <label for="raised-date">Issued on</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="raised-date" type="text" name="quote[expires_at]" class="datepicker validate" value="{{ $due }}" required>
                        <label for="raised-date">Expires on</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer @if($clients->count() == 0) display-none @endif">
            <div class="row">
                <div class="col s12">
                    <button form="new-quote-form" formaction="{{ route('quotes.handleForm')  }}" formmethod="POST" class="modal-close waves-effect waves-green btn-flat">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
@endpush

@push('nav-extra')
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light modal-trigger" href="#new-quote-modal">
        <i class="material-icons">add</i>
    </a>
@endpush
