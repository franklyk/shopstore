<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} / @yield('title', 'Home')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('head')
</head>

<body>

    @yield('layout')

</body>
</html>