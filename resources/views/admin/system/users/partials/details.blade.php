<div class="card">

    <div class="details">

        <dl class="details-list">

            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $user->id }}</dd>

            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9">{{ $user->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $user->email }}</dd>

            <dt class="col-sm-3">Telefone</dt>
            <dd class="col-sm-9">{{ $user->phone }}</dd>

            <dt class="col-sm-3">Verificação do Email</dt>
            <dd class="col-sm-9">{{ $user->email_verified_at }}</dd>

            <dt class="col-sm-3">Cadastrado em:</dt>
            <dd class="col-sm-9">{{ $user->created_at }}</dd>

            <dt class="col-sm-3">Última atualização em:</dt>
            <dd class="col-sm-9">{{ $user->updated_at }}</dd>

        </dl>



    </div>
</div>
