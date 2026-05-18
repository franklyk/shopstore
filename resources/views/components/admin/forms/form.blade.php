@props(['action'])

@php
    $method = strtoupper($attributes->get('method', 'GET'));
@endphp

<form action="{{ $action }}" {{ $attributes->merge(['class' => 'needs-validation p-3']) }}>

    @if ($method !== 'GET')
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
    @endif

    {{ $slot }}

</form>
