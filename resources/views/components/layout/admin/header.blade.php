<header class="header admin-header container-fluid">
    <nav class="navbar navbar-expand-lg container-fluid justify-content-between">

        <x-layout.logo href="{{ route('admin.dashboard') }}" />

        <div class="d-flex align-items-center gap-2">

            @if (auth()->user())
                <small class="fw-semibold text-light user-email-header">
                    {{ auth()->user()->email }}
                </small>
            @endif

<<<<<<< HEAD
            <x-ui.avatar/>
=======
            <x-ui.avatar />
>>>>>>> b96408a (Continua otimização)

        </div>
    </nav>
</header>
