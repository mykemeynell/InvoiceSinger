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
                        <td><a href="#">{{ $invoice->client()->getDisplayName() }}</a></td>
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
                    <div class="input-field col s12">
                        <select name="invoice[client]" id="client-name" class="validate" required>
                            <option disabled selected>Select a client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->getKey() }}">{{ $client->getDisplayName() }}</option>
                            @endforeach
                        </select>
                        <label for="client-name">Client</label>
                    </div>
                </div>
                <div class="row">
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
        <div class="modal-footer">
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

            $('button[form="new-invoice-form"]').on('click', function(event) {
                event.preventDefault();
                let formData = $('#new-invoice-form').serialize();

                axios.interceptors.request.use((config) => {
                    $('#app-progress').css('display', 'block');
                    return config;
                });
                axios.post($(this).attr('formaction'), formData).then((response) => {
                    console.log(response);
                });
            });
        });
    </script>
@endpush
