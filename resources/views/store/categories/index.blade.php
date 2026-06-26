@extends('layouts.store')

@section('title', $category->name)

@section('store')

    <div class="container">

        {{-- HEADER DA CATEGORIA --}}
        <div class="mb-4">

            <h1 class="fw-bold">
                {{ $category->name }}
            </h1>

            @if ($category->parent)
                <small class="text-muted">
                    Categoria: {{ $category->parent->name }}
                </small>
            @endif

            @if ($category->children->count())
                <div class="mt-2">
                    <span class="text-muted">Subcategorias:</span>

                    @foreach ($category->children as $child)
                        <a href="{{ route('categories.show', $child->slug) }}"
                            class="badge bg-primary text-decoration-none">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

        </div>

        {{-- GRID DE PRODUTOS --}}
        <div class="row g-3">

            @forelse ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                    <div class="card h-100 shadow-sm">

                        <img src="https://placehold.co/400x300" class="img-fluid rounded" alt="{{ $product->name }}">

                        {{-- <img src="https://picsum.photos/seed/{{ rand(1, 10000) }}/400/300" class="card-img-top"
                            alt="{{ $product->name }}"> --}}

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>

                            <p class="text-muted small">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <div class="fw-bold text-success">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </div>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary w-100">
                                Ver produto
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">

                    <h5 class="text-muted">
                        Nenhum produto encontrado nesta categoria.
                    </h5>

                </div>
            @endforelse

        </div>

        {{-- PAGINAÇÃO --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>

@endsection
