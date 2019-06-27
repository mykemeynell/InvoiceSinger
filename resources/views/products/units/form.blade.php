@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s6">
                <h4 class="margin-0">{{ ! is_null($unit) ? 'Edit' : 'Create' }} Unit</h4>
            </div>
            <div class="col s6 right-align">
                <button form="unit-form" formmethod="POST" formaction="{{ route('products.units.handleForm') }}" class="waves-effect waves-light btn margin-right-15">Save</button>
                <a href="{{ route('products.units') }}" class="waves-effect waves-light btn red darken-1">Discard</a>
            </div>
        </div>
        <form name="unit-form" id="unit-form">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col s12">

                    <div class="card">
                        <div class="card-content">
                            <div class="row margin-0">
                                <div class="col s6 input-field">
                                    <input type="text" id="unit-name" name="unit[name]" value="@if(! is_null($unit)){{ $unit->getDisplayName() }}@endif">
                                    <label for="unit-name">Name</label>
                                </div>
                                <div class="col s6 input-field">
                                    <input type="text" id="unit-unit" name="unit[unit]" value="@if(! is_null($unit)){{ $unit->getUnit() }}@endif">
                                    <label for="unit-unit">Unit</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
