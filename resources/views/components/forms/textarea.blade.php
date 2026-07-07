@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'for' => null,
])

@php
    $id = $id ?? $name;
@endphp

<div class="form-floating">
    <textarea id="{{ $name }}" name="{{ $name }}" class="form-control" {{ $attributes }}>{{ old($name, $slot) }}</textarea>

    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
</div>
