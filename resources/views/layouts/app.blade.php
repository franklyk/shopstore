<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} @yield('title', 'Home')</title>

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

    @php
        $menuCategories = \App\Models\Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    @endphp

    <header class="container-fluid bg-primary px-3">

        <nav class="navbar navbar-expand-lg container-fluid">

            {{-- LOGO --}}
            <a class="navbar-brand" style="width:150px" href="{{ route('home') }}">
                <img class="w-100" src="{{ asset('images/logo/logo.png') }}">
            </a>

            {{-- BUSCA --}}
            <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar produtos...">
                <button class="btn btn-outline-light">
                    Pesquisar
                </button>
            </form>

            {{-- MENU PRINCIPAL --}}
            <ul class="navbar-nav ms-3">

                {{-- PRODUTOS --}}
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-white fw-semibold"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside">

                        Produtos

                    </a>

                    <div class="dropdown-menu shadow border-0 p-0 overflow-hidden"
                        style="min-width: 360px;">

                        {{-- LINK GERAL --}}
                        <div class="p-3 border-bottom bg-light">

                            <a href="{{ route('products.public.index') }}"
                                class="btn btn-primary w-100">

                                Ver todos os produtos

                            </a>

                        </div>

                        {{-- ACCORDION --}}
                        <div class="accordion accordion-flush"
                            id="categoriesAccordion">

                            @foreach ($menuCategories as $category)

                                <div class="accordion-item border-0">

                                    {{-- HEADER --}}
                                    <h2 class="accordion-header"
                                        id="heading{{ $category->id }}">

                                        <button class="accordion-button collapsed py-3 shadow-none"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $category->id }}"
                                            aria-expanded="false">

                                            <strong>
                                                {{ $category->name }}
                                            </strong>

                                        </button>

                                    </h2>

                                    {{-- BODY --}}
                                    <div id="collapse{{ $category->id }}"
                                        class="accordion-collapse collapse"
                                        data-bs-parent="#categoriesAccordion">

                                        <div class="accordion-body pt-2">

                                            {{-- LINK CATEGORIA PAI --}}
                                            <a href="{{ route('categories.public.show', $category->slug) }}"
                                                class="dropdown-item rounded fw-semibold text-primary mb-2">

                                                Ver tudo em {{ $category->name }}

                                            </a>

                                            {{-- FILHAS --}}
                                            @if ($category->children->count())

                                                <div class="d-flex flex-column gap-1">

                                                    @foreach ($category->children as $child)

                                                        <a href="{{ route('categories.public.show', $child->slug) }}"
                                                            class="dropdown-item rounded">

                                                            {{ $child->name }}

                                                        </a>

                                                    @endforeach

                                                </div>

                                            @else

                                                <small class="text-muted">
                                                    Sem subcategorias
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </li>

            </ul>

            {{-- MENU DIREITA --}}
            <ul class="nav ms-auto align-items-center">

                {{-- CARRINHO --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('cart.index') }}">
                        Carrinho
                    </a>
                </li>

                {{-- VISITANTE --}}
                @guest

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-white"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">

                            <img src="{{ asset('images/users/user.png') }}"
                                class="rounded-circle"
                                width="40"
                                height="40"
                                style="object-fit: cover;">

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('login') }}">

                                    Entrar

                                </a>
                            </li>

                        </ul>

                    </li>

                @endguest

                {{-- AUTENTICADO --}}
                @auth

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">

                            <img src="{{ auth()->user()->avatar
                                ? asset('storage/' . auth()->user()->avatar)
                                : asset('images/users/user.png') }}"
                                class="rounded-circle"
                                width="40"
                                height="40"
                                style="object-fit: cover;">

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
                                    <a class="dropdown-item"
                                        href="{{ route('admin.dashboard') }}">

                                        Dashboard

                                    </a>
                                </li>

                            @endcan

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <form method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item">

                                        Sair

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                @endauth

                {{-- MOBILE --}}
                <li class="nav-item d-block d-md-none">

                    <button class="btn btn-primary"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasMenu">

                        Menu

                    </button>

                </li>

            </ul>

        </nav>

    </header>

    {{-- OFFCANVAS MOBILE --}}
    <div class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasMenu">

        <div class="offcanvas-header">

            <h5 class="offcanvas-title">
                Menu
            </h5>

            <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas">
            </button>

        </div>

        <div class="offcanvas-body">

            <a href="{{ route('products.public.index') }}"
                class="btn btn-primary w-100 mb-3">

                Todos os Produtos

            </a>

            <div class="accordion accordion-flush"
                id="mobileCategoriesAccordion">

                @foreach ($menuCategories as $category)

                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#mobileCollapse{{ $category->id }}">

                                {{ $category->name }}

                            </button>

                        </h2>

                        <div id="mobileCollapse{{ $category->id }}"
                            class="accordion-collapse collapse">

                            <div class="accordion-body">

                                <a href="{{ route('categories.public.show', $category->slug) }}"
                                    class="dropdown-item fw-bold text-primary">

                                    Ver tudo

                                </a>

                                @foreach ($category->children as $child)

                                    <a href="{{ route('categories.public.show', $child->slug) }}"
                                        class="dropdown-item">

                                        {{ $child->name }}

                                    </a>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    {{-- ALERTAS --}}
    @if (session('success'))

        <div class="alert alert-success m-0 rounded-0">
            {{ session('success') }}
        </div>

    @endif

    {{-- CONTEÚDO --}}
    <main class="container mt-4">
        @yield('content')
    </main>

</body>

</html>