@props([
    'id' => 'deleteModal'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirmar exclusão</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                Tem certeza que deseja excluir:

                <br>

                <strong data-role="name"></strong>  ?

                <br>

                ID: <strong data-role="id"></strong>
            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <form method="POST" data-role="form">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Excluir
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>