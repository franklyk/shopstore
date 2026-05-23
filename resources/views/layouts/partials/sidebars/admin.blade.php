<aside class="col-lg-2 min-vh-100 p-0 bg-primary">

    @can('view dashboard')

        <div class="p-3 border-bottom border-light">

            <a href="{{ route('admin.dashboard') }}"
               class="text-decoration-none text-white">

                <h5 class="m-0">
                    Dashboard
                </h5>

            </a>

        </div>

    @endcan

    <nav class="nav flex-column p-2 gap-1">

        @can('view products')

            <a href="{{ route('products.index') }}"
               class="nav-link text-white rounded">

                Produtos

            </a>

        @endcan

        @can('view categories')

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link text-white rounded">

                Categorias

            </a>

        @endcan

        @can('view users')

            <a href="{{ route('admin.users.index') }}"
               class="nav-link text-white rounded">

                Usuários

            </a>

        @endcan

        <hr class="border-light">

        <a href="{{ route('home') }}"
           class="nav-link text-white rounded">

            Loja

        </a>

        @auth

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="nav-link text-white border-0 bg-transparent w-100 text-start rounded">

                    Sair

                </button>

            </form>

        @endauth

    </nav>

</aside>