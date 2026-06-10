<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <x-theme.variables />

    <title>{{ env('APP_NAME') }} / @yield('title', 'Home')</title>

    @vite(['resources/sass/bootstrap.scss','resources/sass/app.scss', 'resources/js/app.js'])

    @stack('head')
</head>

<body>

    @yield('layout')

</body>
</html>
