@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="new-product-family" name="new-product-family">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <span>New Product Family</span>
                    </div>

                    <div class="row">
                        <div class="col s12 input-field">
                            <input type="text" id="family-name" name="family[name]">
                            <label for="family-name">Name</label>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <div class="row">
            <div class="col s12 right-align">
                <button form="new-product-family" class="waves-effect waves-light btn">Save</button>
            </div>
        </div>
    </div>
@endsection
