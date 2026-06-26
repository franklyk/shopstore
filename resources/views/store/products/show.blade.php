@extends('layouts.store')

@section('title', $product->name)

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($product->description), 150))

@section('store')

    <div class="container py-4">

        {{-- Breadcrumb --}}
        <nav class="mb-4 text-sm text-gray-500">
            <a href="{{ route('home') }}">Home</a>
            /
            <span>{{ $product->name }}</span>
        </nav>

        <div class="row">

            {{-- Imagem --}}
            <div class="col-md-5">
                <img src="https://placehold.co/600x600" class="img-fluid rounded" alt="{{ $product->name }}">
                {{-- <img src="https://picsum.photos/seed/{{ rand(1, 10000) }}/600/600" class="card-img-top"
                    alt="{{ $product->name }}"> --}}
            </div>

            {{-- Dados --}}
            <div class="col-md-7">

                <h1 class="mb-3">
                    {{ $product->name }}
                </h1>

                <div class="mb-3">
                    @foreach ($product->categories as $category)
                        <span class="badge bg-secondary">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <h3 class="text-success mb-4">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </h3>

                <p class="mb-4">
                    {{ $product->description }}
                </p>

                <p>
                    <strong>Estoque:</strong>
                    {{-- {{ $product->stock }} --}}
                    @if ($product->stock > 0)
                        <span class="text-success">
                            Em estoque
                        </span>
                    @else
                        <span class="text-danger">
                            Esgotado
                        </span>
                    @endif
                </p>

                <div class="d-flex gap-2 mt-4">

                    <button class="btn btn-primary">
                        Adicionar ao carrinho
                    </button>

                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        Continuar comprando
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
