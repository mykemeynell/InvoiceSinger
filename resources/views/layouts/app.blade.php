<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.components._head')
@push('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endpush
<body class="@yield('body_classes')">
<div id="app">
    @stack('beginning')

    @if(! isset($show_header) || $show_header == true)
        @include('layouts.components.header._header')
    @endif

    <section>
        @yield('content')
    </section>

    @if(isset($show_fab) && $show_fab == true)
        @include('layouts.components.misc._fab-button')
    @endif
</div>

@if(! isset($show_progress) || $show_progress == false)
    <div id="app-progress" class="progress margin-y-0" style="display:none;">
        <div class="indeterminate"></div>
    </div>
@endif

    @stack('before-scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('end')
</body>
</html>
