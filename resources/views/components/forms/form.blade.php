@props(['action' => null, 'title' => null])

@php
    $method = strtoupper($attributes->get('method', 'GET'));
@endphp


<form
    action="{{ $action }}"
    method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
    {{ $attributes->except('method')->merge(['class' => 'form']) }}
>

    @if ($method !== 'GET')
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
    @endif

    {{ $slot }}

</form>
