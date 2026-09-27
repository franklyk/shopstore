<div class="table-container">

    <x-ui.table>

        <x-slot:table>

            <thead>

                <tr>

                    <th scope="col">NOME</th>

                    <th scope="col">SLUG</th>

                    <th scope="col">CARGOS</th>

                    <th scope="col">STATUS</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($departments as $department)

                    <tr
                        scope="row"
                        class="clickable-row"
                        data-href="{{ route('admin.hr.departments.show', $department) }}"
                    >

                        <td>
                            {{ $department->name }}
                        </td>

                        <td>
                            {{ $department->slug }}
                        </td>

                        <td>
                            {{ $department->positions_count }}
                        </td>

                        <td>

                            <span class="badge text-bg-{{ $department->status->color }}">

                                {{ $department->status->name }}

                            </span>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </x-slot:table>

    </x-ui.table>

</div>


@if ($departments->hasPages())

    <div class="listing-pagination">

        {{ $departments->links() }}

    </div>

@endif
