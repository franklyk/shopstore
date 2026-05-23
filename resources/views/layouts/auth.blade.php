@extends('layouts.base')

@section('layout')

<body class="bg-primary d-flex justify-content-center align-items-center"
      style="min-height: 100dvh;">

    <main class="container d-flex justify-content-center align-items-center">

        <div class="card shadow-lg w-100 p-3"
             style="max-width: 420px;">

            @yield('auth')

        </div>

    </main>

</body>

@endsection
