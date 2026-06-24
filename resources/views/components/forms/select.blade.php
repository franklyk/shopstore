@props([
    'name',
    'options' => [],
    'value' => null,
    'field_label' => null,
    'placeholder' => 'Selecione',
])

<x-forms.field :name="$name" :label="$field_label" >

    <select
        {{ $attributes->merge(['class' => 'form-input']) }}
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
