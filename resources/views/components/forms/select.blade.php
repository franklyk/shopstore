@props([
    'name',
    'options' => [],
    'value' => null,
])

<x-forms.field :name="$name">

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-input">

        @foreach ($options as $key => $label)

            <option
                value="{{ $key }}"
                @selected(old($name, $value) == $key)>

                {{ $label }}

            </option>

        @endforeach

    </select>

</x-forms.field>
