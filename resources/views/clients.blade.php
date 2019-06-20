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
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->isActive() ? 'Yes' : 'No' }}</td>
                            <td><a href="#">{{ $client->getDisplayName() }}</a></td>
                            <td><a href="mailto:{{ $client->getEmailAddress() }}">{{ $client->getEmailAddress() }}</a></td>
                            <td><a href="tel:{{ $client->getTelephone() }}">{{ $client->getTelephone() }}</a></td>
                            <td class="right-align">&pound;0.00</td>
                            <td class="right-align"><a class="waves-effect waves-light btn">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="center-align">
                                No Clients
                            </td>
                        </tr>
                    @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a class="btn-floating btn-large halfway-fab waves-effect waves-light" href="{{ route('clients.form') }}">
        <i class="material-icons">add</i>
    </a>
@endpush
