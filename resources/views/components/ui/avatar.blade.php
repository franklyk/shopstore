<ul class="nav ms-auto align-items-center">

    @guest

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                <img src="{{ asset('images/users/user.png') }}" class="rounded-circle" width="40" height="40"
                    style="object-fit: cover;">
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

            <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2" href="#" role="button"
                data-bs-toggle="dropdown">

                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/users/user.png') }}"
                    class="rounded-circle" width="40" height="40" style="object-fit: cover;">

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                @can('view dashboard')
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endcan

                <li>
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        Minha Conta
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('profile.addresses.index') }}">
                        Endereços
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('profile.orders.index') }}">
                        Meus Pedidos
                    </a>
                </li>

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

    {{-- MOBILE --}}
    <li class="nav-item d-block d-md-none">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
            Menu
        </button>
    </li>
    
</ul>
