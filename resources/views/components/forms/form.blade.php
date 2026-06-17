@props(['action' => null, 'title' => null])

@php
    $method = strtoupper($attributes->get('method', 'GET'));
@endphp

<form action="{{ $action }}" {{ $attributes->merge(['class' => 'form']) }}>

    @if ($method !== 'GET')
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
    @endif

    {{ $slot }}

</form>
