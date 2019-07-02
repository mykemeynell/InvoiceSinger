<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head></head>
<body class="page-pdf">
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    @stack('beginning')
    @yield('content')
    @stack('end')
</body>
</html>
