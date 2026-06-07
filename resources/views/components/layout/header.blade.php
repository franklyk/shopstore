<header class="header">

    <x-layout.logo />
    
    <nav class="nav">

        {{-- LOGO --}}

        {{-- LEFT MENU --}}
        <div class="menu menu--left">

            {{-- Produtos (placeholder por enquanto) --}}
            <x-store.products-menu />

        </div>

        {{-- RIGHT MENU --}}
        <div class="menu menu--right">

            {{-- Carrinho --}}
            <a href="{{ route('cart.index') }}" class="menu__link">
                Carrinho
            </a>

            {{-- Guest --}}
            @guest
                <x-layout.guest-menu />
            @endguest

            {{-- Auth --}}
            @auth
                <x-layout.user-menu />
            @endauth

        </div>

        {{-- MOBILE --}}
        <button class="menu-toggle" type="button">
            Menu
        </button>

    </nav>

</header>
