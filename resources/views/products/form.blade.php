@inject('family_service', \InvoiceSinger\Storage\Service\ProductFamilyService)
@inject('unit_service', \InvoiceSinger\Storage\Service\UnitService)

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s6">
                <h4 class="margin-y-0">{{ ! is_null($product) ? 'Edit' : 'Create' }} Product</h4>
            </div>
            <div class="col s6 right-align">
                <button type="submit" form="product-form" formaction="{{ route('products.handleForm') }}" formmethod="POST" class="waves-effect waves-light btn-flat margin-right-15">Save</button>
                <a href="{{ route('products') }}" class="waves-effect waves-light btn-flat">Cancel</a>
                @if(! is_null($product))
                    <form name="delete-product-form" id="delete-product-form" class="display-inline-block">
                        {!! csrf_field() !!}
                        <button type="submit" form="delete-product-form" formaction="{{ route('products.handleDelete', ['product_id' => $product->getKey()]) }}" formmethod="POST" class="margin-left-15 waves-effect waves-light btn red darken-1">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <form name="product-form" id="product-form">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                <span>Product</span>
                            </div>
                            <div class="row margin-top-30">
                                <div class="col s12 input-field">
                                    <select name="product[family]" id="product-family" class="validate" required>
                                        @foreach($family_service->fetch() as $family)
                                            <option value="{{ $family->getKey() }}" @if(! is_null($product) && $product->getFamily() === $family->getKey()) selected @endif>{{ $family->getDisplayName() }}</option>
                                        @endforeach
                                    </select>
                                    <label for="product-family">Family</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="product-sku" name="product[sku]" value="@if(!is_null($product)){{ $product->getSku() }}@endif">
                                    <label for="product-sku">SKU</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="product-name" name="product[name]" class="validate" value="@if(!is_null($product)){{ $product->getDisplayName() }}@endif" required>
                                    <label for="product-name">Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <textarea name="product[description]" id="product-description" class="materialize-textarea">@if(!is_null($product)){{ $product->getDescription() }}@endif</textarea>
                                    <label for="product-description">Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <span class="prefix">{!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}</span>
                                    <input type="number" min="0" step="0.01" name="product[price]" id="product-price" class="validate" value="@if(!is_null($product)){{ $product->getPrice() }}@endif" required>
                                    <label for="product-price">Price</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <select name="product[unit]" id="product-unit" class="validate" required>
                                        <option selected disabled>Select</option>
                                        @foreach($unit_service->fetch() as $unit)
                                            <option value="{{ $unit->getKey() }}" @if(! is_null($product) && $product->getUnit() === $unit->getKey()) selected @endif>{{ $unit->getDisplayName() }}</option>
                                        @endforeach
                                    </select>
                                    <label for="product-unit">Unit</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    @include('layouts.components.misc._tax-rates-dropdown', [
                                        'tax_rate_select_id' => 'product-tax-rate',
                                        'tax_rate_select_name' => 'product[tax_rate]',
                                        'object' => $product
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
