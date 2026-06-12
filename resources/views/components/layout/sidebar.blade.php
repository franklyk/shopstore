<aside class="sidebar">

    <x-menu.list>
        @can('view dashboard')
            <x-menu.link href="{{ route('admin.dashboard') }}" label="Dashboard" />
        @endcan
        @can('view orders')
            <x-menu.link href="{{ route('admin.shipments.index') }}" label="Pedidos" />
        @endcan
        @can('view products')
            <x-menu.link href="{{ route('admin.products.index') }}" label="Produtos" />
        @endcan
        @can('view categories')
            <x-menu.link href="{{ route('admin.categories.index') }}" label="Categorias" />
        @endcan
        @can('view users')
            <x-menu.link href="{{ route('admin.users.index') }}" label="Usuários" />
        @endcan
    </x-menu.list>

</aside>


{{-- @can('view dashboard')
        <div class="">

            <a href="{{ route('admin.dashboard') }}" class="">


                Dashboard

            </a>

        </div>
    @endcan

    <nav class="sidebar-nav flex-column p-2 gap-1">

        @can('view products')
            <a href="{{ route('admin.products.index') }}" class="">
                Produtos
            </a>
        @endcan

        @can('view categories')
            <a href="{{ route('admin.categories.index') }}" class="">
                Categorias
            </a>
        @endcan

        @can('view users')
            <a href="{{ route('admin.users.index') }}" class="">
                Usuários
            </a>
        @endcan

        <hr class="border-light">

        <a href="{{ route('home') }}" class="">
            Loja
        </a>

        @auth

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="">

                    Sair

                </button>

            </form>

        @endauth

    </nav> --}}
