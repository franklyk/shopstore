@props(['links' => null])

<div class="listing">

    <div class="listing-content">

        <div class="table-container">

            <x-ui.table>

                <x-slot:table>
                    {{ $table }}
                </x-slot:table>

            </x-ui.table>

        </div>

        @if ($links)
            <div class="listing-pagination">
                {{ $links->links() }}
            </div>
        @endif

    </div>

    @isset($sidebar)

        <aside class="listing-sidebar">

            {{ $sidebar }}

        </aside>

    @endisset

</div>
