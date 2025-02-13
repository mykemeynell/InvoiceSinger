@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s12">
                <h4 class="margin-0">Clients</h4>
            </div>
        </div>

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
                            <td>{{ $client->getDisplayName() }}</td>
                            <td><a href="mailto:{{ $client->getEmailAddress() }}">{{ $client->getEmailAddress() }}</a></td>
                            <td><a href="tel:{{ $client->getTelephone() }}">{{ $client->getTelephone() }}</a></td>
                            <td class="right-align">&pound;0.00</td>
                            <td class="right-align"><a class="waves-effect waves-light btn" href="{{ route('clients.form', ['client_id' => $client->getKey()]) }}">View</a></td>
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
