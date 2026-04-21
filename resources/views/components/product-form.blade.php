@props(['product' => null])


@php
    $isEdit = isset($product);

@endphp

<form action="{{ $isEdit ? route('products.update', $product->id) : route('products.store') }}" method="POST">

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Preço</label>
        <input type="text" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Estoque</label>
        <input type="text" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        Voltar
    </a>

    <button class="btn btn-{{ $isEdit ? 'warning' : 'success' }}">
        Salvar
    </button>
</form>
