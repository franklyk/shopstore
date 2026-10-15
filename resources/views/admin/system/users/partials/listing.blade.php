<div class="table-container">

    <x-ui.table>

        <x-slot:table>

            <thead>

                <tr>

                    <th scope="col"></th>

                    <th scope="col">ID</th>

                    <th scope="col">Nome</th>

                    <th scope="col">Email</th>

                    <th scope="col">Cargo</th>

                    <th scope="col">Status</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($users as $user)
                    <tr scope="row" class="clickable-row" data-href="{{ route('admin.system.users.show', $user) }}">

                        <td>
                            "imagem"
                        </td>

                        <td>
                            {{ $user->id }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->roles->first()?->name }}
                        </td>

                        <td>
                            @if ($user->status)
                                <span class="badge text-bg-{{ $user->status->color }}">
                                    {{ $user->status->name }}
                                </span>
                            @else
                                <span class="badge text-bg-secondary">Sem status</span>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </x-slot:table>

    </x-ui.table>


</div>

@if ($users->hasPages())
    <div class="listing-pagination">

        {{ $users->links() }}

    </div>
@endif
