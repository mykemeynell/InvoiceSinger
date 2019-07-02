@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s6">
                <h4 class="margin-0">Settings</h4>
            </div>
            <div class="col s6 right-align">
                <button form="settings-form" class="waves-effect waves-light btn">Save</button>
            </div>
        </div>

        <div class="row margin-top-30">
            <div class="col s12">
                @include('settings._tabs')
            </div>
            <form id="settings-form" name="settings-form">
                <div id="application" class="col s12">@include('settings.panels._application')</div>
                <div id="invoices" class="col s12">@include('settings.panels._invoices')</div>
                <div id="quotes" class="col s12">@include('settings.panels._quotes')</div>
                <div id="email" class="col s12">@include('settings.panels._emails')</div>
                <div id="online-payments" class="col s12">@include('settings.panels._online-payments')</div>
                <div id="data" class="col s12">@include('settings.panels._data-management')</div>
            </form>
        </div>
    </div>
@endsection

@push('end')
    <script>
        $(document).ready(function(){
            $('.settings-tabs').tabs();
        });
    </script>
@endpush
