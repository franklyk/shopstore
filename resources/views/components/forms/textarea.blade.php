<textarea
    name="{{ $name }}"
    class="form-control"
    rows="{{ $rows ?? 3 }}"
>{{ old($name, $value ?? '') }}</textarea>