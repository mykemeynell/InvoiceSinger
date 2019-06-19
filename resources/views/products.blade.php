@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 right-align  margin-top-15 margin-bottom-30">
                <a href="#" class="waves-effect waves-dark grey lighten-3 black-text btn margin-right-15">Product Families</a>
                <a href="#" class="waves-effect waves-dark grey lighten-3 black-text btn">Tax Rates</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Family</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Tax Rate</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>212-965-66D</td>
                        <td>Default Product Family</td>
                        <td>Example Product</td>
                        <td>This is an example product, not intended to be sold.</td>
                        <td>&pound;14.99</td>
                        <td>Unit</td>
                        <td>Default Tax (20%)</td>
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
