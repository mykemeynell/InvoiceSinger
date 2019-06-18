<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.components._head')
<body>
@stack('beginning')
@include('layouts.components.header._header')

<section>
    @yield('content')
</section>

@include('layouts.components.misc._fab-button')
@stack('before-scripts')
<script src="{{ asset('js/app.js') }}"></script>
@stack('end')
</body>
</html>
