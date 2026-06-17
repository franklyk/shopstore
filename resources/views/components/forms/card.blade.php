@props(['title' => null])

<div class="card-vs d-flex justify-content-center align-items-center">

    <div class="w-100">
        <div class="rounded-2 py-3">

            <x-forms.flash />

            {{ $slot }}

        </div>

    </div>

</div>
