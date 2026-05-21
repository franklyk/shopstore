@extends('layouts.store')

@section('content')

<div class="row">

    {{-- SIDEBAR --}}
    <div class="col-md-3">

        <div class="list-group">

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

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="list-group-item list-group-item-action text-danger w-100 text-start">
                    Sair
                </button>
            </form>

        </div>

    </div>

    {{-- CONTEÚDO --}}
    <div class="col-md-9">

        <div class="card mb-3">
            <div class="card-body">

                <h3>Minha Conta</h3>

                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <h4>Endereços</h4>

                @forelse($user->addresses as $address)

                    <div class="border p-2 mb-2 rounded">

                        <strong>{{ $address->name }}</strong>

                        @if($address->is_default)
                            <span class="badge bg-primary">Principal</span>
                        @endif

                        <div class="text-muted small">
                            {{ $address->street }}, {{ $address->number }}<br>
                            {{ $address->city }}/{{ $address->state }}
                        </div>

                    </div>

                @empty
                    <p>Nenhum endereço cadastrado.</p>
                @endforelse

            </div>
        </div>

    </div>

</div>

@endsection