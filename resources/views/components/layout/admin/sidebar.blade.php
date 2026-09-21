<aside class="sidebar">

    <x-menu.list>

        @can('view dashboard')
            <x-menu.link href="{{ route('admin.dashboard') }}">
                <x-icons.dashboard />
                Dashboard
            </x-menu.link>
        @endcan

        {{-- @can('view users')
            <x-menu.accordion label="Usuários" id="menu-users">

                <x-menu.link href="{{ route('admin.users.employees.index') }}">

                    <x-icons.user />

                    Funcionários

                </x-menu.link>

                <x-menu.link href="{{ route('admin.users.customers.index') }}">

                    <x-icons.user />

                    Clientes

                </x-menu.link>

            </x-menu.accordion>
        @endcan --}}

        @can('view users')
            <x-menu.link href="{{ route('admin.users.index') }}" label="">
                <x-icons.user />
                Usuários
            </x-menu.link>
        @endcan

        @can('view products')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.package />
                Produtos
            </x-menu.link>
        @endcan

        @can('view categories')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.tags />
                Categorias
            </x-menu.link>
        @endcan

        @can('view orders')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.shopingcart />
                Pedidos
            </x-menu.link>
        @endcan

        @can('view shipments')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.truck />
                Envios
            </x-menu.link>
        @endcan



        @can('view suppliers')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.building />
                Fornecedores
            </x-menu.link>
        @endcan

        @can('view collections')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.layers />
                Coleções
            </x-menu.link>
        @endcan

        @can('view import batches')
            <x-menu.link href="{{ route('admin.products.index') }}" label="">
                <x-icons.file-text />
                PDF
            </x-menu.link>
        @endcan

    </x-menu.list>

</aside>
