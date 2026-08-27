@props(['table' => null, 'links' => null])


<x-layout.admin.page-container>

    {{ $slot }}


    <div class="">

        @if ($table)
            <div class="table-container overflow-auto">
                <x-ui.table>
                    <x-slot:table>
                        {{ $table }}
                    </x-slot:table>
                </x-ui.table>
            </div>
        @endif

    </div>
    <x-ui.footer>

        <div class="my-1">
            {{ $links->links() }}
        </div>
    </x-ui.footer>


</x-layout.admin.page-container>
