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

    <header class="container-fluid d-flex align-items-center justify-content-center px-3 bg-primary">

        <nav class="navbar container-fluid">
            <div class="container-fluid d-flex align-items-center">

                <a class="navbar-brand" style="width:150px" href="{{ route('home') }}">
                    <img class="w-100" src="{{ asset('images/logo/logo.png') }}">
                </a>

                <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-light">Pesquisar</button>
                </form>

                @php

                    $menuCategories = \App\Models\Category::with('children')
                        ->whereNull('parent_id')
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get();

                @endphp

                <li class="nav-item dropdown ms-3">

                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown">

                        Categorias

                    </a>

                    <div class="dropdown-menu p-3" style="min-width: 320px;">

                        <div class="accordion accordion-flush" id="categoriesAccordion">

                            @foreach ($menuCategories as $category)
                                <div class="accordion-item">

                                    <h2 class="accordion-header">

                                        <button class="accordion-button collapsed py-2" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#category{{ $category->id }}">

                                            {{ $category->name }}

                                        </button>

                                    </h2>

                                    <div id="category{{ $category->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#categoriesAccordion">

                                        <div class="accordion-body p-2">

                                            @if ($category->children->count())
                                                <ul class="list-unstyled mb-0">

                                                    @foreach ($category->children as $child)
                                                        <li>

                                                            <a href="#" class="dropdown-item rounded">

                                                                {{ $child->name }}

                                                            </a>

                                                        </li>
                                                    @endforeach

                                                </ul>
                                            @else
                                                <span class="text-muted small">
                                                    Sem subcategorias
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </li>

                <ul class="nav ms-auto align-items-center">

                    @can('view products')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('products.index') }}">
                                Produtos
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cart.index') }}">
                            Carrinho
                        </a>
                    </li>

                    @guest

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown">

                                <img src="{{ asset('images/users/user.png') }}" class="rounded-circle" width="40"
                                    height="40" style="object-fit: cover;">

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        Entrar
                                    </a>
                                </li>

                            </ul>

                        </li>

                    @endguest

                    @auth

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2" href="#"
                                role="button" data-bs-toggle="dropdown">

                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/users/user.png') }}"
                                    class="rounded-circle" width="40" height="40" style="object-fit: cover;">

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="#">
                                        Minha Conta
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        Meus Pedidos
                                    </a>
                                </li>

                                @can('view dashboard')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Dashboard
                                        </a>
                                    </li>
                                @endcan

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit" class="dropdown-item">
                                            Sair
                                        </button>
                                    </form>

                                </li>

                            </ul>

                        </li>

                    @endauth

                    <button class="btn btn-primary d-block d-md-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions">

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

</body>

</html>
