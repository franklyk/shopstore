@props(['id', 'action', 'name'])


<div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Excluir
                </h5>
            </div>

            <div class="modal-body">
                Deseja excluir <strong>{{ $name }}</strong> ?
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path d="M9 14L4 9l5-5" />

                        <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                    </svg>
                    Cancelar
                </button>

                <form action="{{ $action }}" method="POST">
                    {{-- @dd($action) --}}
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 6h18" />
                            <path d="M8 6V4h8v2" />
                            <path d="M19 6l-1 14H6L5 6" />
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                        </svg>
                        Excluir
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>
