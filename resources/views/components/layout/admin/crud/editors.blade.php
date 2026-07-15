<x-layout.admin.page-container>

    {{ $slot }}

    <div class="card p-5 bg-light">
        {{ $body }}

        <div class="mt-5 d-flex gap-1 justify-content-end w-100" style="width: min-content">
            {{ $button }}
        </div>
    </div>

</x-layout.admin.page-container>
