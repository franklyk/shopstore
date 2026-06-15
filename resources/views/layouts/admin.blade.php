{{-- @extends('layouts.base')

@section('layout')

    <x-layout.header />

    <div class="admin-layout">

        <x-layout.sidebar />

        <main class="admin-content">

            <x-admin.forms.flesh />

            @yield('admin')

        </main>

    </div>

@endsection --}}

@extends('layouts.base')

@section('layout')
    <div class="container-fluid layout-admin">

        <x-layout.header />
        <div class="row">

            <x-layout.sidebar />

            <main class="content-admin">

                <x-admin.forms.flesh />

                @yield('admin')

            </main>

        </div>

    </div>
@endsection
