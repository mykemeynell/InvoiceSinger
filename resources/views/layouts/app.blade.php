<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.components._head')
<body class="@yield('body_classes')">
@stack('beginning')

@if(! isset($show_header) || $show_header == true)
    @include('layouts.components.header._header')
@endif

<section>
    @yield('content')
</section>

@if(! isset($show_fab) || $show_fab == true)
    @include('layouts.components.misc._fab-button')
@endif

@stack('before-scripts')
<script src="{{ asset('js/app.js') }}"></script>
@stack('end')
</body>
</html>
