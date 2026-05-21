@extends('layouts.base')

@section('layout')

<div class="container-fluid">

    <div class="row">

        @include('layouts.partials.headers.header')
        <aside class="col-2 min-vh-100 p-0 bg-primary">
            @include('layouts.partials.sidebars.admin')
        </aside>

        <main class="col p-4">
            <x-admin.forms.flesh />
            @yield('content')
        </main>

    </div>

</div>

@endsection