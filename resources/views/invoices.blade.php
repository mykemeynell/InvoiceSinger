@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <td>{{ $invoice->getStatus() }}</td>
                        <td><a href="#">{{ $invoice->getInvoiceKey() }}</a></td>
                        <td>{{ $invoice->getRaisedAt() }}</td>
                        <td>{{ $invoice->getDueAt() }}</td>
                        <td><a href="#">{{ $invoice->getClientId() }}</a></td>
                        <td class="right-align">&pound;0.00</td>
                        <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
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
                <div class="row">
{{--                    <div class="input-field col s12">--}}
{{--                        <i class="material-icons prefix">search</i>--}}
{{--                        <input type="text" id="autocomplete-input" class="autocomplete" data-source="{{ route('api.clients.fetch') }}">--}}
{{--                        <label for="autocomplete-input">Search for a client</label>--}}
{{--                    </div>--}}
                    <div class="input-field col s12">
                        <select name="client[id]" id="client-name">
                            <option disabled selected>Select a client</option>

                        </select>
                        <label for="client-name">Client</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
@endpush
