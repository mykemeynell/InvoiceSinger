@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Active</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Telephone</th>
                            <th class="right-align">Balance</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Yes</td>
                        <td><a href="#">Silicon Labs</a></td>
                        <td><a href="#">info@siliconlabs.example</a></td>
                        <td>+44 1234 567890</td>
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
