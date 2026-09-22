<aside class="sidebar">

    <x-menu.list>

        {{-- Dashboard --}}
        @can('view dashboard')
            <x-menu.link href="{{ route('admin.dashboard') }}">

                <x-icons.dashboard />

                Dashboard

            </x-menu.link>
        @endcan


        {{-- RH --}}
        @can('view users')
            <x-menu.accordion label="RH" id="menu-rh" :active="request()->routeIs('admin.hr.*')">

                <x-slot:icon>

                    <x-icons.user />

                </x-slot:icon>

                <x-menu.link href="{{ route('admin.hr.employees.index') }}">
                    Funcionários
                </x-menu.link>

                <x-menu.link href="#">
                    Cargos
                </x-menu.link>

                <x-menu.link href="#">
                    Departamentos
                </x-menu.link>

                <x-menu.link href="#">
                    Férias e afastamentos
                </x-menu.link>

                <x-menu.link href="#">
                    Jornada e frequência
                </x-menu.link>

                <x-menu.link href="#">
                    Benefícios
                </x-menu.link>

                <x-menu.link href="#">
                    Avaliações
                </x-menu.link>

            </x-menu.accordion>
        @endcan


        {{-- Comercial --}}
        @can('view products')

            <x-menu.accordion label="Comercial" id="menu-commercial" :active="request()->routeIs('admin.products.*') ||
                request()->routeIs('admin.categories.*') ||
                request()->routeIs('admin.collections.*')">

                <x-slot:icon>

                    <x-icons.package />

                </x-slot:icon>

                @can('view products')
                    <x-menu.link href="{{ route('admin.products.index') }}">
                        Produtos
                    </x-menu.link>
                @endcan

                @can('view categories')
                    <x-menu.link href="#">
                        Categorias
                    </x-menu.link>
                @endcan

                @can('view collections')
                    <x-menu.link href="#">
                        Coleções
                    </x-menu.link>
                @endcan

                <x-menu.link href="#">
                    Preços
                </x-menu.link>

                <x-menu.link href="#">
                    Promoções
                </x-menu.link>

            </x-menu.accordion>

        @endcan


        {{-- Compras --}}
        @can('view suppliers')
            <x-menu.accordion label="Compras" id="menu-purchasing" :active="request()->routeIs('admin.suppliers.*')">

                <x-slot:icon>

                    <x-icons.building />

                </x-slot:icon>

                <x-menu.link href="{{ route('admin.suppliers.index') }}">
                    Fornecedores
                </x-menu.link>

                <x-menu.link href="#">
                    Compras
                </x-menu.link>

                <x-menu.link href="#">
                    Recebimentos
                </x-menu.link>

            </x-menu.accordion>
        @endcan


        {{-- Estoque --}}
        @can('view stock')
            <x-menu.accordion label="Estoque" id="menu-stock" :active="request()->routeIs('admin.stock.*')">

                <x-slot:icon>

                    <x-icons.package />

                </x-slot:icon>

                <x-menu.link href="#">
                    Estoque
                </x-menu.link>

                <x-menu.link href="#">
                    Movimentações
                </x-menu.link>

                <x-menu.link href="#">
                    Reservas
                </x-menu.link>

                <x-menu.link href="#">
                    Entradas
                </x-menu.link>

            </x-menu.accordion>
        @endcan


        {{-- Operações --}}
        @can('view orders')
            <x-menu.accordion label="Operações" id="menu-operations" :active="request()->routeIs('admin.orders.*') || request()->routeIs('admin.shipments.*')">

                <x-slot:icon>

                    <x-icons.shopping-cart />

                </x-slot:icon>

                <x-menu.link href="{{ route('admin.orders.index') }}">
                    Pedidos
                </x-menu.link>

                <x-menu.link href="#">
                    Separação
                </x-menu.link>

                <x-menu.link href="#">
                    Embalagem
                </x-menu.link>

                <x-menu.link href="#">
                    Expedição
                </x-menu.link>

                <x-menu.link href="#">
                    Devoluções
                </x-menu.link>

            </x-menu.accordion>
        @endcan


        {{-- Atendimento --}}
        @can('view users')
            <x-menu.accordion label="Atendimento" id="menu-support" :active="request()->routeIs('admin.support.*')">

                <x-slot:icon>

                    <x-icons.headset />

                </x-slot:icon>

                <x-menu.link href="#">
                    Clientes
                </x-menu.link>

                <x-menu.link href="#">
                    Atendimentos
                </x-menu.link>

                <x-menu.link href="#">
                    Tickets
                </x-menu.link>

                <x-menu.link href="#">
                    Solicitações
                </x-menu.link>

            </x-menu.accordion>
        @endcan


        {{-- Financeiro --}}
        @can('view dashboard')
            <x-menu.accordion label="Financeiro" id="menu-financial" :active="request()->routeIs('admin.financial.*')">

                <x-slot:icon>

                    <x-icons.wallet />

                </x-slot:icon>

                <x-menu.link href="#">
                    Pagamentos
                </x-menu.link>

                <x-menu.link href="#">
                    Recebimentos
                </x-menu.link>

                <x-menu.link href="#">
                    Reembolsos
                </x-menu.link>

                <x-menu.link href="#">
                    Conciliação
                </x-menu.link>

            </x-menu.accordion>
        @endcan

        {{-- Marketing --}}
        @can('view dashboard')
            <x-menu.accordion label="Marketing" id="menu-marketing" :active="request()->routeIs('admin.marketing.*')">

                <x-slot:icon>

                    <x-icons.megaphone />

                </x-slot:icon>

                <x-menu.link href="#">
                    Campanhas
                </x-menu.link>

                <x-menu.link href="#">
                    Cupons
                </x-menu.link>

                <x-menu.link href="#">
                    Promoções
                </x-menu.link>

                <x-menu.link href="#">
                    Comunicação
                </x-menu.link>

            </x-menu.accordion>
        @endcan

        {{-- Administração --}}
        @can('view dashboard')
            <x-menu.accordion label="Administração" id="menu-administration" :active="request()->routeIs('admin.administration.*')">

                <x-slot:icon>

                    <x-icons.settings />

                </x-slot:icon>

                <x-menu.link href="{{ route('admin.users.index') }}">
                    Usuários
                </x-menu.link>

                <x-menu.link href="#">
                    Permissões
                </x-menu.link>

                <x-menu.link href="#">
                    Status
                </x-menu.link>

                <x-menu.link href="#">
                    Configurações
                </x-menu.link>

                <x-menu.link href="#">
                    Integrações
                </x-menu.link>

            </x-menu.accordion>
        @endcan

    </x-menu.list>

</aside>
