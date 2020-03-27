@extends('layouts.base', ['title' => 'Mon compte'])

@section('content')
    <div class="w-11/12 lg:w-8/12 mx-auto">
        <h1 class="text-xl">Informations du compte</h1>
        @include('auth.partials.nav')
        <div class="shadow">
            @yield('account-content')
        </div>
    </div>
@endsection
