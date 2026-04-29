<select name="{{ $name }}" class="form-select">

    @foreach ($options as $key => $label)
        <option value="{{ $key }}"
            @selected(old($name, $value ?? '') == $key)
        >
            {{ $label }}
        </option>
    @endforeach

</select>