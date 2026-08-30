@props(['links' => null])

<div class="listing">

    <div class="table-container">
        <x-ui.table>
            <x-slot:table>
                {{ $table }}
            </x-slot:table>
        </x-ui.table>
    </div>

    <div class="listing-pagination">
        {{ $links->links() }}
    </div>

</div>
