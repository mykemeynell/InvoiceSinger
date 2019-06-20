@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Quote</th>
                            <th>Created</th>
                            <th>Due</th>
                            <th>Client</th>
                            <th class="right-align">Amount</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->getStatus() }}</td>
                        <td><a href="#">INV-18-0032</a></td>
                        <td>22/06/2019</td>
                        <td>21/07/2019</td>
                        <td><a href="#">info@siliconlabs.example</a></td>
                        <td class="right-align">&pound;0.00</td>
                        <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
                    </tr>
                    @endforeach
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
                    <div class="col s12 input-field">
                        <select name="invoice[client_id]">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
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
