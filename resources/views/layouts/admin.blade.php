<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} @yield('title', 'Home')</title>

    <!-- Bootstrap 5 CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script>
        window.APP_CONFIG = {
            baseUrl: "{{ url('/admin') }}",
            resource: "{{ request()->segment(2) }}"
        };

        window.csrfToken = "{{ csrf_token() }}";
    </script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>

    <header class="container-fluid d-flex align-items-center justify-content-center bg-primary">

        <nav class="navbar container-fluid">
            <div class="container-fluid d-flex align-items-center">
                <a class="navbar-brand" style="width:150px" href="{{ route('home') }}">
                    <img class="w-100" src="{{ asset('images/logo/logo.png') }}">
                </a>

            </div>
        </nav>
    </header>


    {{-- <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
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
    </div> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- Sidebar estilo dashboard --}}

    <div class="container-fluid">

        <div class="row">

            <aside class="col-2 min-vh-100 p-0 bg-primary">

                <div class="p-3 border-bottom">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-light">
                    <h5>Dashboard</h5>
                    </a>
                </div>

                <nav class="nav flex-column p-2">

                    <a href="{{ route('products.index') }}" class="nav-link text-light">
                        Produtos
                    </a>

                    <a href="{{ route('categories.index') }}" class="nav-link text-light">
                        Categorias
                    </a>

                    <a href="{{ route('users.index') }}" class="nav-link text-light">
                        Usuários
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-light">
                            Sair
                        </button>
                    </form>

                </nav>

            </aside>

            <main class="col p-4">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>
