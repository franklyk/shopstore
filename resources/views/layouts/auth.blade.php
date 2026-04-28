<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} / @yield('title', 'Home')</title>

    <!-- Bootstrap 5 CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="container d-flex justify-content-center align-items-center bg-primary" style="min-height: 100dvh; border: margin: auto; overflow-y:auto">

    <main class="container d-flex justify-content-center align-items-center" >
        
        <div class="card shadow-lg w-100 p-3" style="max-width: 420px;">

            @yield('auth')

        </div>

    </main>

</body>
</html>