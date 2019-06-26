@inject('family_service', \InvoiceSinger\Storage\Service\ProductFamilyService)
@inject('tax_rate_service', \InvoiceSinger\Storage\Service\TaxRateService)
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s6">
                <h4 class="margin-y-0">{{ ! is_null($product) ? 'Edit' : 'Create' }} Product</h4>
            </div>
            <div class="col s6 right-align">
                <button type="submit" form="product-form" formaction="{{ route('products') }}" formmethod="POST" class="waves-effect waves-light btn margin-right-15">Save</button>
                <a href="#" class="waves-effect waves-light btn red darken-1">Discard</a>
            </div>
        </div>

        <form name="product-form" id="product-form">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                <span>Product</span>
                            </div>
                            <div class="row margin-top-30">
                                <div class="col s12 input-field">
                                    <select name="product[family]" id="product-family">
                                        @foreach($family_service->fetch() as $family)
                                            <option value="{{ $family->getKey() }}">{{ $family->getDisplayName() }}</option>
                                        @endforeach
                                    </select>
                                    <label for="product-family">Family</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="product-sku" name="product[sku]">
                                    <label for="product-sku">SKU</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="product-name" name="product[name]">
                                    <label for="product-name">Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <textarea name="product[description]" id="product-description" class="materialize-textarea"></textarea>
                                    <label for="product-description">Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <span class="prefix">{!! app()->make(\mykemeynell\Support\CurrencyHtmlEntities::class)->entity(settings('app.currency')) !!}</span>
                                    <input type="number" min="0" step="0.01" name="product[price]" id="product-price">
                                    <label for="product-price">Price</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <select name="product[unit]" id="product-unit">
                                        <option selected disabled>Select</option>
                                    </select>
                                    <label for="product-unit">Unit</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <select name="product[tax_rate]" id="product-tax-rate">
                                        @foreach($tax_rate_service->fetch() as $tax_rate)
                                            <option value="{{ $tax_rate->getKey() }}">{{ $tax_rate->getDisplayName() }}</option>
                                        @endforeach
                                    </select>
                                    <label for="product-tax-rate">Tax Rate</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
