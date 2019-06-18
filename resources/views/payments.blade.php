@extends('layouts.app')

@section('content')
    <div class="container">
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
                    <tr>
                        <td>18/06/2019</td>
                        <td>12/06/2019</td>
                        <td><a href="#">INV-18-0032</a></td>
                        <td><a href="#">Silicon Labs</a></td>
                        <td class="right-align">&pound;0.00</td>
                        <td>Online Payment</td>
                        <td>Paid via WorldPay integration.</td>
                        <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
                    </tr>
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