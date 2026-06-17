@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'for'
])

@php
    $id = $id ?? $name;
@endphp

<x-forms.field>

    <textarea
        id="{{ $id }}"
        :name="{{ $name }}"
        class="form-input"
        {{ $attributes }}
    >{{ old($name, $slot) }}</textarea>

    @if($label)
        <x-forms.label for="{{ :$for }}" :label="$label"/>
    @endif

</x-forms.field>
