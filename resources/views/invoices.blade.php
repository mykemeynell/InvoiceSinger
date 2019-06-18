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
                    <tr>
                        <td>Yes</td>
                        <td><a href="#">QUO-18-0032</a></td>
                        <td>22/06/2019</td>
                        <td>21/07/2019</td>
                        <td><a href="#">info@siliconlabs.example</a></td>
                        <td class="right-align">&pound;0.00</td>
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
