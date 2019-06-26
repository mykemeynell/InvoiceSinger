@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s12 m6">
                <h4 class="margin-0">{{ ! is_null($taxRate) ? 'Edit' : 'Create' }} Tax Rate</h4>
            </div>
            <div class="col s12 m6 right-align">
                <button form="new-product-family" formmethod="POST" formaction="{{ route('products.taxRates.handleForm') }}" class="waves-effect waves-light btn margin-right-15">Save</button>
                <a href="{{ route('products.taxRates') }}" class="waves-effect waves-light btn red darken-1">Discard</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <form id="new-product-family" name="new-product-family">
                    {!! csrf_field() !!}
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s6 input-field">
                                    <input type="text" id="tax-rate-name" name="taxRate[name]" value="@if(! is_null($taxRate)){{ $taxRate->getDisplayName() }}@endif">
                                    <label for="tax-rate-name">Name</label>
                                </div>
                                <div class="col s6 input-field">
                                    <input type="number" id="tax-rate-amount" min="0" max="100" step="0.01" name="taxRate[amount]" value="@if(! is_null($taxRate)){{ $taxRate->getAmount() }}@endif">
                                    <label for="tax-rate-amount">Amount (%)</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
