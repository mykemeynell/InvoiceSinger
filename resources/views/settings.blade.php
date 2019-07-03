@extends('layouts.app')

@section('content')
    <div class="container margin-top-30">
        <div class="row padding-y-30">
            <div class="col s6">
                <h4 class="margin-0">Settings</h4>
            </div>
            <div class="col s6 right-align">
                <button form="settings-form" formaction="{{ route('settings.handleForm') }}" formmethod="POST" class="waves-effect waves-light btn">Save</button>
            </div>
        </div>

        <div class="row margin-top-30">
            <div class="col s12">
                @include('settings._tabs')
            </div>
            <form id="settings-form" name="settings-form">
                {!! csrf_field() !!}
                <div class="col s12 padding-y-30" id="application">@include('settings.panels._application')</div>
                <div class="col s12 padding-y-30" id="invoices">@include('settings.panels._invoices')</div>
                <div class="col s12 padding-y-30" id="quotes">@include('settings.panels._quotes')</div>
                <div class="col s12 padding-y-30" id="email">@include('settings.panels._emails')</div>
                <div class="col s12 padding-y-30" id="online-payments">@include('settings.panels._online-payments')</div>
                <div class="col s12 padding-y-30" id="data">@include('settings.panels._data-management')</div>
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
