@props([
    'id',
    'action',
    'name'
])


<div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Excluir
                </h5>
            </div>

            <div class="modal-body">
                Deseja excluir <strong>{{ $name }}</strong>  ?
            </div>

            <div class="modal-footer">

                <button 
                    type="button" 
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancelar
                </button>

                <form action="{{ $action }}" method="POST">
                    {{-- @dd($action) --}}
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