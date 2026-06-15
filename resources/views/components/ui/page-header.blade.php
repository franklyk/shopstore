<div class="page-header mb-4 align-items-center">

    <div class="d-flex justify-content-between align-items-center ">

        <div class="text-white">

            <h1 class="h3 mb-1">
                {{ $title }}
            </h1>

            @isset($description)
                <p class="mb-0">
                    {{ $description }}
                </p>
            @endisset

        </div>

        @isset($actions)
            <div class="d-flex flex-column align-items-end w-50">
                {{ $actions }}
            </div>
        @endisset

    </div>

</div>
