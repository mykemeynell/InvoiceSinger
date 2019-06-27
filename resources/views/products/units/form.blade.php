@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s6">
                <h4 class="margin-0">{{ ! is_null($unit) ? 'Edit' : 'Create' }} Unit</h4>
            </div>
            <div class="col s6 right-align">
                <button form="unit-form" formmethod="POST" formaction="{{ route('products.units.handleForm') }}" class="waves-effect waves-light btn-flat margin-right-15">Save</button>
                <a href="{{ route('products.units') }}" class="waves-effect waves-light btn-flat">Cancel</a>
                @if(! is_null($unit))
                <form class="display-inline-block" name="delete-unit-form" id="delete-unit-form">
                    {!! csrf_field() !!}
                    <button type="submit" form="delete-unit-form" formaction="{{ route('products.units.handleDelete', ['unit_id' => $unit->getKey()]) }}" formmethod="POST" class="waves-effect waves-light btn red darken-1 margin-left-15">Delete</button>
                </form>
                @endif
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
