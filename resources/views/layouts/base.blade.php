@php

    $title = "Placeholder"

@endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} @empty(!$title) - {{$title}} @else {{ null }} @endempty</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #footer::before {
            content: '';
            display: -webkit-box;
            display: flex;
            background: url({{ asset('/storage/images/wave-6.svg') }}) 0 1px no-repeat #f7fafc;
            background-size: auto;
            background-size: cover;
            transform: rotateY(180deg);
            margin-top: 0;
            left: 0;
            right: 0;
            z-index: 1;
            padding-top: 12rem;
        }
        .flip-wave.content::before {
            transform: rotateY(180deg);
        }
    </style>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    @livewireScripts

</head>
<body class="bg-gray-100 font-sans flex-col h-full dark:bg-gray-900 dark:text-white">
<header class="nav bg-white dark:bg-gray-800 border lg:border-none border-gray-200">
    @php
        $auth = (new Auth())::user();
        $user = (new \App\User());
    @endphp
    @if(!isset($header))
        @include("partials.menu", compact('user', $user))
    @else
        <div class="bg-blue-400 shadow text-white">
            <div class="w-11/12 mx-auto">
                <a class="text-4xl" href="{{ route('post.index') }}"><i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>
    @endif
</header>
<main class="@if(isset($flip_wave) && $flip_wave == true) flip-wave @else {{ null }} @endif content">
    <div class="pt-5 pb-24 mb:pb-16 @if(isset($full_width) && $full_width == false) w-11/12 mx-auto @else w-full @endif">
        @yield('content')
    </div>
</main>

@include('partials.mobile-menu')

<footer id="footer" class="relative footer bg-blue-500 text-white pb-20 hidden lg:visible"> <!-- mt-10 -->
    <div class="w-4/5 m-auto flex flex-col lg:flex-row">
        <div class="flex-1 lg:mr-5">
            <h1 class="text-xl mb-3">{{ config('app.name') }}</h1>
            <p>Tout droits réservés</p>
        </div>
        <div class="flex-1 lg:mr-5">
            <h1 class="text-xl mb-3">Informations légales</h1>
            <ul>
                <li><a href="" class="">Mentions légales</a></li>
                <li><a href="" class="">En savoir plus</a></li>
            </ul>
        </div>
        <div class="flex-1">
            <h1 class="text-xl mb-3">Newsletter</h1>
            <input type="text" class="input my-2" value="{{ (\Illuminate\Support\Facades\Auth::check()) ? $auth->email : "Votre adresse email" }}">
            <button type="submit" class="btn btn-blue btn-block">Inscription</button>
        </div>
    </div>
    <p class="text-center text-white">Copyright 2019. {{ config('app.name') }} tous droits réservés.</p>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/nav.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
@yield('script')
<script>
    let search = document.getElementById('search')
    let searchMenu = document.getElementById('search-menu')

    let timeout = null;
    search.addEventListener('keyup', function (e) {
        clearTimeout(timeout);

        timeout = setTimeout(function () {
            if(search.length > 0) {
                searchMenu.classList.remove('hidden')
                searchMenu.classList.toggle('block')
            } else {
                searchMenu.classList.toggle('hidden')
            }
        }, 1000);
    });

</script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>
