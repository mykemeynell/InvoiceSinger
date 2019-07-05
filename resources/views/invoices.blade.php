@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s12">
                <h4 class="margin-0">Invoices</h4>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Invoice</th>
                            <th>Raised</th>
                            <th>Due</th>
                            <th>Client</th>
                            <th class="right-align">Amount</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($invoices as $invoice)
                    <tr>
                        <td>@include('layouts.components.misc._status-badge', ['item' => $invoice])</td>
                        <td><a href="{{ route('invoices.form', $invoice->getKey()) }}">{{ $invoice->getInvoiceKey() }}</a></td>
                        <td>{{ $invoice->getRaisedAt()->format('d F Y') }}</td>
                        <td>{{ $invoice->getDueAt()->format('d F Y') }}</td>
                        <td><a href="{{ route('clients.form', $invoice->client()->getKey()) }}">{{ $invoice->client()->getDisplayName() }}</a></td>
                        <td class="right-align">{!! currencyEntity() !!}{{ number_format($invoice->getTotal(), 2) }}</td>
                        <td class="right-align"><a href="{{ route('invoices.form', $invoice->getKey()) }}" class="waves-effect waves-light btn">View</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="center-align">No Invoices</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light modal-trigger" href="#new-invoice-modal">
        <i class="material-icons">add</i>
    </a>
@endpush

@push('end')
    <div id="new-invoice-modal" class="modal">
        <div class="modal-content">
            <h4>Create New Invoice</h4>
            <form name="new-invoice-form" id="new-invoice-form">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="input-field col s12">
                        @if($clients->count() > 0)
                        <select name="invoice[client]" id="client-name" class="validate" required="required">
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
                        <input id="raised-date" type="text" name="invoice[raised_at]" class="datepicker validate" value="{{ $today }}" required>
                        <label for="raised-date">Raised on</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="raised-date" type="text" name="invoice[due_at]" class="datepicker validate" value="{{ $due }}" required>
                        <label for="raised-date">Due by</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer @if($clients->count() == 0) display-none @endif">
            <div class="row">
                <div class="col s12">
                    <button form="new-invoice-form" formaction="{{ route('invoices.handleForm')  }}" formmethod="POST" class="modal-close waves-effect waves-green btn-flat">Create</button>
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
