@props(['action', 'title'])

@php
    $method = strtoupper($attributes->get('method', 'GET'));
@endphp


<x-forms.card :title="$title">

    <form action="{{ $action }}" {{ $attributes->merge(['class' => 'needs-validation p-3']) }}>

        @if ($method !== 'GET')
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif
        @endif

        {{ $slot }}

    </form>
</x-forms.card>
