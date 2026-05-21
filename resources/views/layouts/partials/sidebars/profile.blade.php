<div class="card shadow-sm border-0">

    <div class="card-body p-0">

        <div class="list-group list-group-flush">

            <a href="{{ route('profile.show') }}"
               class="list-group-item list-group-item-action">

                Minha Conta

            </a>

            <a href="{{ route('addresses.index') }}"
               class="list-group-item list-group-item-action">

                Endereços

            </a>

            <a href="#"
               class="list-group-item list-group-item-action">

                Meus Pedidos

            </a>

            @can('view dashboard')
                <a href="{{ route('admin.dashboard') }}"
                   class="list-group-item list-group-item-action">

                    Dashboard

                </a>
            @endcan

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="list-group-item list-group-item-action text-danger w-100 text-start border-0">

                    Sair

                </button>

            </form>

        </div>

    </div>

</div>