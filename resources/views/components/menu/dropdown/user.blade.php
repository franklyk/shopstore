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

    @can('view orders')
        <li>
            <a class="dropdown-item" href="{{ route('profile.orders.index') }}">
                Meus Pedidos
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
