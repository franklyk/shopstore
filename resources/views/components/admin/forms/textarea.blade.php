@props([
    'label' => null,
    'name',
    'id' => null,
    'for'
])

@php
    $id = $id ?? $name;
@endphp

<div class="mb-3">

    @if($label)
        <x-admin.forms.label for="{{ :$for }}" class="form-label" :label="$label"/>
    @endif

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control"
        {{ $attributes }}
    >{{ old($name, $slot) }}</textarea>

</div>