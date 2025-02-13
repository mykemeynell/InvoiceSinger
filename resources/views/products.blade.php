@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s6">
                <h4 class="margin-0">Products</h4>
            </div>
            <div class="col s6 right-align margin-top-15 margin-bottom-30">
                <a href="{{ route('products.families') }}" class="waves-effect waves-dark grey lighten-3 black-text btn margin-right-15">Product Families</a>
                <a href="{{ route('products.units') }}" class="waves-effect waves-dark grey lighten-3 black-text btn margin-right-15">Units</a>
                <a href="{{ route('products.taxRates') }}" class="waves-effect waves-dark grey lighten-3 black-text btn">Tax Rates</a>
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
                            <th class="right-align">Price</th>
                            <th>Unit</th>
                            <th>Tax Rate</th>
                            <th class="right-align">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php /** @var \InvoiceSinger\Storage\Entity\ProductEntity $product */ @endphp
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->getSku() }}</td>
                        <td>{{ $product->family()->getDisplayName() }}</td>
                        <td>{{ $product->getDisplayName() }}</td>
                        <td>{{ $product->getDescription() }}</td>
                        <td class="right-align">{!! $currency !!}{{ number_format($product->getPrice(), 2) }}</td>
                        <td>{{ $product->unit()->getDisplayName() }}</td>
                        <td>{{ ! is_null($product->taxRate()) ? $product->taxRate()->getInformativeName() : "No Tax" }}</td>
                        <td class="right-align"><a href="{{ route('products.form', ['product_id' => $product->getKey()]) }}" class="waves-effect waves-light btn">View</a></td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="center-align">No Products</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('nav-extra')
    <a href="{{ route('products.form') }}" class="btn-floating btn-large halfway-fab waves-effect waves-light">
        <i class="material-icons">add</i>
    </a>
@endpush

