@props([
    'bg_header' => null,
    'bg_card' => null,
    'border_header' => null,
    'color' => null,
    'title',
])

<div class="card shadow-sm h-100">

    <div class="
        card-header
        d-flex
        align-items-center
        @if ($bg_header)
            bg-{{ $bg_header }} text-white
        @endif

        @if($border_header)
            border-start border-4 border-{{ $border_header }}
        @endif
    ">

        <div class="card-title mb-0">
            <h5 class="mb-0
            @if ($color)
                text-{{ $color }}
            @else

            text-muted
            @endif">
                {{ $title }}
            </h5>
        </div>

        @isset($actions)
            <div class="ms-auto d-flex gap-2">
                {{ $actions }}
            </div>
        @endisset

    </div>

    <div class="card-body
    @if ($bg_card)
    bg-{{ $bg_card }}
        text-white
        text-center">

    @endif
        {{ $slot }}
    </div>

</div>
