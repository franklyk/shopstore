@extends('layouts.base')

@section('view-port')
<div class="layout-admin">
        <x-layout.admin.header />


        <div class="container-admin">

            <x-layout.admin.sidebar />

            <main class="content-admin">

                @yield('layout-admin')


            </main>

        </div>
        <x-ui.footer />

        @yield('modals')

    </div>
@endsection
