<x-layout.admin.page>

    <x-slot:header>

        <x-ui.page-header
            title="Funcionários"
            description="Gerenciamento dos funcionários do administrativo."
        />

    </x-slot:header>

    <div class="card">

        <div class="card-body">

            @forelse ($users as $user)

                <div>
                    {{ $user->name }}
                </div>

            @empty

                <p>Nenhum funcionário encontrado.</p>

            @endforelse

        </div>

    </div>

</x-layout.admin.page>
