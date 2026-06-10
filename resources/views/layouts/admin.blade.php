@extends('layouts.base')

@section('layout')

    <x-layout.header />

    <div class="admin-layout">

        <x-layout.sidebar />

        <main class="admin-content">

            <x-admin.forms.flesh />

            @yield('admin')

        </main>

    </div>

@endsection
