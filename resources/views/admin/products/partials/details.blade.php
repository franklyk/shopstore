<div class="card">

    <div class="details">

        <div class="container-image">

            @if ($product->images->isNotEmpty())
                <div class="preview-image">

                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="image"
                        alt="{{ $product->name }}">

                </div>
            @else
                <div class="preview-placeholder">

                    <x-icons.camera />

                </div>
            @endif

        </div>

        <dl class="details-list">

            <dt class="details-label">Nome</dt>
            <dd class="details-value">
                {{ $product->name }}
            </dd>

            <dt class="details-label">SKU</dt>
            <dd class="details-value">
                {{ $product->sku }}
            </dd>

            <dt class="details-label">Descrição</dt>
            <dd class="details-value">
                {{ $product->description ?: '—' }}
            </dd>

            <dt class="details-label">Marca</dt>
            <dd class="details-value">
                {{ $product->brand?->name ?? '—' }}
            </dd>

            <dt class="details-label">Categoria</dt>
            <dd class="details-value">
                @forelse ($product->categories as $category)
                    {{ $category->name }}{{ !$loop->last ? ' / ' : '' }}
                @empty
                    —
                @endforelse
            </dd>

            <dt class="details-label">Coleção</dt>
            <dd class="details-value">
                @forelse ($product->collections as $collection)
                    {{ $collection->name }}{{ !$loop->last ? ' / ' : '' }}
                @empty
                    —
                @endforelse
            </dd>

            <dt class="details-label">Fornecedor</dt>
            <dd class="details-value">
                @forelse ($product->suppliers as $supplier)
                    {{ $supplier->name }}{{ !$loop->last ? ' / ' : '' }}
                @empty
                    —
                @endforelse
            </dd>

            <dt class="details-label">Status</dt>
            <dd class="details-value">

                <span class="badge text-bg-{{ $product->status->color }}">
                    {{ $product->status->name }}
                </span>

            </dd>

            <dt class="details-label">Preço</dt>
            <dd class="details-value">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </dd>

            <dt class="details-label">Estoque</dt>
            <dd class="details-value">
                {{ $product->stocks->first()?->quantity ?? 0 }}
            </dd>

            <dt class="details-label">Cadastrado em</dt>
            <dd class="details-value">
                {{ $product->created_at->format('d/m/Y H:i') }}
            </dd>

            <dt class="details-label">Última atualização em</dt>
            <dd class="details-value">
                {{ $product->updated_at->format('d/m/Y H:i') }}
            </dd>

        </dl>

    </div>

</div>
