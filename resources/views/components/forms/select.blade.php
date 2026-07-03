@props([
    'name',
    'options' => [],
    'value' => null,
    'field_label' => null,
    'placeholder' => 'Selecione',
])
@php
    // garante formato correto
    if ($options instanceof \Illuminate\Support\Collection) {
        $options = $options->toArray();
    }

    // valida estrutura (debug seguro)
    foreach ($options as $key => $label) {
        if (!is_scalar($key) || !is_scalar($label)) {
            throw new \Exception("Select options inválidas para [$name]. Use pluck('label', 'id').");
        }
    }
@endphp

<x-forms.field :name="$name" :label="$field_label" >

    <select
        {{ $attributes->merge(['class' => 'form-select']) }}
        name="{{ $name }}"
        id="{{ $name }}"
    >

        <option value="">
            {{ $placeholder }}
        </option>

        @foreach ($options as $key => $label)
            <option
                value="{{ $key }}"
                @selected(old($name, $value) == $key)
            >
                {{ $label }}
            </option>
        @endforeach

    </select>

</x-forms.field>
