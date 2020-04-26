<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} @hasSection('title') - {{ $slot }} @endif</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    @livewireScripts
</head>
<body class="position-relative" style="background: #81b7ff29">

@auth
    @include('partials.menu')
@endauth

<div class="@if(isset($full)) container-fluid @else container container-mobile @endif pb-9">
    @yield('content')
</div>

@auth
    @include('partials.mobile-menu')
@endauth

<script src="{{ asset('js/index.js') }}"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@yield('script')
</body>
</html>
