<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }} => @yield('title', 'Home')</title>

    <!-- Bootstrap 5 CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                Loja Virtual
            </a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link">Sair</button>
                </form>
            @endauth
        </div>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
