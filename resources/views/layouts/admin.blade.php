@extends('layouts.base')

@section('layout')
    <div class="layout-admin">

        <x-layout.admin.header />
        <div class="row">

            <x-layout.sidebar />

            <main class="content-admin">

                <x-ui.flesh />

                @yield('admin')

                <footer class="footer fw-bold">
                    © {{ now()->year }} Loja virtual / Todos os direitos reservados.
                </footer>
            </main>

        </div>

        @yield('modals')

    </div>
@endsection
