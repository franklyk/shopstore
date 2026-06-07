@extends('layouts.store')

@section('title', 'Meus Endereços')

@section('content')

    <div class="card">

        <div class="card-header d-flex align-items-center justify-content-between">

            <div class="card-title">
                <h2>Meus Endereços</h2>
            </div>

            <x-buttons.button href="{{ route('profile.addresses.create') }}" color="primary" icon="plus"
                label="Novo Endereço" />

        </div>

        <div class="card-body">

            @forelse ($addresses as $address)
                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="d-flex align-items-center gap-2 mb-2">

                                <strong>
                                    {{ $address->name }}
                                </strong>

                                @if ($address->is_default)
                                    <span class="badge bg-primary">
                                        Principal
                                    </span>
                                @endif

                            </div>

                            <div>

                                {{ $address->street }},
                                {{ $address->number }}

                                @if ($address->complement)
                                    - {{ $address->complement }}
                                @endif

                            </div>

                            <div>
                                {{ $address->district }}
                            </div>

                            <div>
                                {{ $address->city }}/{{ $address->state }}
                            </div>

                            <div class="text-muted">
                                CEP: {{ $address->cep }}
                            </div>

                        </div>

                        <div class="d-flex gap-1">
                            @if ($address->is_default)
                                <span class="badge bg-primary d-flex align-items-center">
                                    Principal
                                </span>
                            @else
                                <form action="{{ route('profile.addresses.default', $address) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Tornar Principal
                                    </button>

                                </form>
                            @endif

                            <x-buttons.button href="{{ route('profile.addresses.edit', $address) }}" color="warning"
                                icon="edit" />


                            <x-buttons.button type="button" color="danger" icon="trash" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $address->id }}" />
                        </div>
                    </div>
                </div>
            @empty

                <div class="text-center py-5">

                    <p class="text-muted mb-3">
                        Você ainda não possui endereços cadastrados.
                    </p>

                    <x-buttons.button href="{{ route('profile.addresses.create') }}" color="primary" icon="plus"
                        label="Cadastrar Endereço" />

                </div>
            @endforelse

        </div>

        @if ($addresses->hasPages())
            <div class="card-footer">

                {{ $addresses->links() }}

            </div>
        @endif

    </div>
    @can('delete categories')

        @foreach ($addresses as $address)
            <x-modal.delete :action="route('profile.addresses.destroy', $address)" :id="$address->id" :name="$address->name" />
        @endforeach

    @endcan

@endsection
