@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>Family Name</th>
                        <th class="right-align">Options</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a href="{{ route('products.families.form') }}" class="btn-floating btn-large halfway-fab waves-effect waves-light">
        <i class="material-icons">add</i>
    </a>
@endpush
