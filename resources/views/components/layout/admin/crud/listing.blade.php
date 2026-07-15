@props(['table' => null, 'links' => null])


<x-layout.admin.page-container>

    {{ $slot }}

    <div class="card p-5 bg-light">
        @if ($table)
            <x-ui.table>
                <x-slot:table>
                    {{ $table }}
                </x-slot:table>
            </x-ui.table>
        @endif
        <div class="my-5">
            {{ $links->links() }}
        </div>
    </div>


</x-layout.admin.page-container>
