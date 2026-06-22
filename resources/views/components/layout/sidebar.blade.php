<aside class="sidebar">

    <x-menu.list>

        @can('view dashboard')
            <x-menu.link href="{{ route('admin.dashboard') }}" label="Dashboard" />
        @endcan

        @can('view orders')
            <x-menu.link href="{{ route('admin.orders.index') }}" label="Pedidos" />
        @endcan

        @can('view shipments')
            <x-menu.link href="{{ route('admin.shipments.index') }}" label="Envios" />
        @endcan

        @can('view products')
            <x-menu.link href="{{ route('admin.products.index') }}" label="Produtos" />
        @endcan

        @can('view products')
            <x-menu.link href="{{ route('admin.suppliers.index') }}" label="Fornecedores" />
        @endcan

        @can('view categories')
            <x-menu.link href="{{ route('admin.categories.index') }}" label="Categorias" />
        @endcan

        @can('view users')
            <x-menu.link href="{{ route('admin.users.index') }}" label="Usuários" />
        @endcan

    </x-menu.list>

</aside>
