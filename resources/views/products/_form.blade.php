<form method="POST" data-role="form">
    @csrf
    <input type="hidden" name="_method" value="POST" data-role="method">

    <div class="mb-2">
        <input type="text" name="name" class="form-control" placeholder="Nome">
    </div>

    <div class="mb-2">
        <input type="number" name="price" class="form-control" placeholder="Preço">
    </div>

    <button class="btn btn-primary" type="submit">
        Salvar
    </button>
</form>