<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} @yield('title', 'Home')</title>

    <!-- Bootstrap 5 CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header class="container-fluid d-flex align-items-center justify-content-center">

        <nav class="navbar container bg-primary">
            <div class="container-fluid d-flex align-items-center">

                <a class="navbar-brand" style="width:150px" href="{{ route('home') }}">
                    <img class="w-100" src="{{ asset('images/logo/logo.png') }}">
                </a>

                <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-light">Pesquisar</button>
                </form>

                <ul class="nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('products.index') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cart.index') }}">Carrinho</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-white">
                                Sair
                            </button>
                        </form>
                    @endauth

                    <button class="btn btn-primary d-block d-md-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        Menu
                    </button>

                </ul>

            </div>
        </nav>
    </header>


    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script> --}}

</body>

</html>
