@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s12 m6">
                <h4 class="margin-0">{{ ! is_null($family) ? 'Edit' : 'Create' }} Product Family</h4>
            </div>
            <div class="col s12 m6 right-align">
                <button form="new-product-family" formmethod="POST" formaction="{{ route('products.families.handleForm') }}" class="waves-effect waves-light btn margin-right-15">Save</button>
                <a href="{{ route('products.families') }}" class="waves-effect waves-light btn red darken-1">Discard</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <form id="new-product-family" name="new-product-family">
                    {!! csrf_field() !!}
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                <span>New Product Family</span>
                            </div>

                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="family-name" name="family[name]" value="@if(! is_null($family)){{ $family->getDisplayName() }}@endif">
                                    <label for="family-name">Name</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
