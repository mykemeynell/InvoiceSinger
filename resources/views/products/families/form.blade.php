@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row margin-y-30">
            <div class="col s12 m6">
                <h4 class="margin-0">{{ ! is_null($family) ? 'Edit' : 'Create' }} Product Family</h4>
            </div>
            <div class="col s12 m6 right-align">
                <button form="new-product-family" formmethod="POST"
                        formaction="{{ route('products.families.handleForm', ['family_id' => ! is_null($family) ? $family->getKey() : null]) }}"
                        class="waves-effect waves-light btn-flat margin-right-15">Save
                </button>
                <a href="{{ route('products.families') }}" class="waves-effect waves-light btn-flat">Cancel</a>
                @if(! is_null($family))
                    <form name="delete-family-form" id="delete-family-form" class="display-inline-block">
                        <button type="submit" form="delete-family-form"
                                formaction="{{ route('products.families.handleDelete', ['family_id' => $family->getKey()]) }}"
                                formmethod="POST"
                                class="waves-effect waves-light btn red darken-1 margin-left-15">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <form id="new-product-family" name="new-product-family">
                    {!! csrf_field() !!}
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input type="text" id="family-name" name="family[name]"
                                           value="@if(! is_null($family)){{ $family->getDisplayName() }}@endif">
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
