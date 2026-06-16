
@extends('layouts.base')

@section('layout')
    <div class="layout-admin">

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
