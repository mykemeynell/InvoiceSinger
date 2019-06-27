@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row margin-y-30">
            <div class="col s12">
                <h4>Product Families</h4>
            </div>
        </div>

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
                    @forelse($families as $family)
                        <tr>
                            <td>{{ $family->getDisplayName() }}</td>
                            <td class="right-align"><a href="{{ route('products.families.form', ['family_id' => $family->getKey()]) }}" class="waves-light waves-effect btn">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="center-align">No Product Families</td>
                        </tr>
                    @endforelse
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
