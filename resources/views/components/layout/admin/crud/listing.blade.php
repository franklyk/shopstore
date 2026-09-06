<div class="listing">

    <div class="listing-content">

        {{ $slot }}

    </div>

    @isset($sidebar)
        <aside class="listing-sidebar">

            {{ $sidebar }}

        </aside>
    @endisset

</div>
