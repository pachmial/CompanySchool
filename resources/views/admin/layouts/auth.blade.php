<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMKN 4 Kota Bogor')</title>

    @vite(['resources/css/app.css', 'resources/css/layout.css'])
    @stack('styles')
</head>
<body class="auth-body">

    @yield('content')

    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>