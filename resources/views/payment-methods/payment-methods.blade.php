@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row margin-y-30">
            <div class="col s12">
                <h4>Payment Methods</h4>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Enabled</th>
                        <th>Protected</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($methods as $method)
                        <tr>
                            <td>{{ $method->getDisplayName() }}</td>
                            <td>{{ $method->isEnabled() ? 'Yes' : 'No' }}</td>
                            <td>{{ $method->isProtected() ? 'Yes' : 'No' }}</td>
                            <td class="right-align"><a
                                        href="#"
                                        class="waves-effect waves-light btn">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="center-align">No Payment Methods</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a href="#" class="btn-floating btn-large halfway-fab waves-effect waves-light">
        <i class="material-icons">add</i>
    </a>
@endpush
