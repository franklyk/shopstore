@extends('layouts.base')

@section('layout')
    <div class="layout-admin">

        <x-layout.admin.header />
        
        <div class="row">

            <x-layout.admin.sidebar />

            <main class="content-admin">

                @yield('admin')

            </main>

        </div>

        @yield('modals')

    </div>
@endsection
