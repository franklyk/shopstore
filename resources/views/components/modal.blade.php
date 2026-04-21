@props(['product' => null])

<div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirmar exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Tem certeza que deseja excluir <strong>{{ $product->name }}</strong>?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">Excluir</button>
        </form>
      </div>

    </div>
  </div>
</div>