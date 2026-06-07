@props(['label' => null, 'name'])

<div class="mb-3">

    @if ($label)
        <x-admin.forms.label :for="$name" :label="$label" />
    @endif

    {{ $slot }}

</div>
