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

                @foreach ($employees as $employee)
                    <tr scope="row" class="clickable-row" data-href="{{ route('admin.hr.employees.show', $employee) }}">

                        <td>
                            "imagem"
                        </td>

                        <td>
                            {{ $employee->id }}
                        </td>

                        <td>
                            {{ $employee->name }}
                        </td>

                        <td>
                            {{ $employee->email }}
                        </td>

                        <td>
                            {{ $employee->roles->first()?->name }}
                        </td>

                        <td>
                            <span class="badge text-bg-{{ $employee->status->color }}">
                                {{ $employee->status->name }}
                            </span>
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </x-slot:table>

    </x-ui.table>


</div>

@if ($employees->hasPages())
    <div class="listing-pagination">

        {{ $employees->links() }}

    </div>
@endif
