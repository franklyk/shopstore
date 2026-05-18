@props(['title'])

<div class="card">

    <div class="card-header d-flex align-items-center">

        <div class="card-title">
            <h2>{{ $title }}</h2>
        </div>

        @isset($actions)
            <div class="ms-auto d-flex gap-2">
                {{ $actions }}
            </div>
        @endisset

    </div>

    <div class="card-body">
        {{ $slot }}
    </div>

</div>


