<header class="header container-fluid">
    <nav class="navbar navbar-expand-lg container-fluid justify-content-between">
        <x-layout.logo />

        <div class="d-flex align-items-center gap-2">
            

            <small class="fw-semibold text-light">
                {{ auth()->user()->email }}
            </small>

            <x-ui.avatar :src="auth()->user()->avatar ?? null" :alt="auth()->user()->email" />

        </div>
    </nav>
</header>
