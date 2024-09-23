<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | Sistema de inventario</title>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    </head>
    <body>

        @include('partials.nav')
        
        @yield('content')

        
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>
