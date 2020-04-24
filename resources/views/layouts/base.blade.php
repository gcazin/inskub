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
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    @livewireScripts
</head>
<body class="font-sans flex-col h-full dark:bg-gray-900 dark:text-white" style="background: #f5f5f5">
<header class="nav dark:bg-gray-800 border-b-4 border-white" style="background: url(http://localhost:8000/storage/users/profile_background.png); background-size: cover; background-position: center">
    @php
        $auth = (new Auth())::user();
        $user = (new \App\User());
    @endphp
    @if(!isset($header))
        @include("partials.menu", compact('user', $user))
    @else
        <div class="border-b border-gray-200 text-white">
            <div class="flex w-11/12 mx-auto">
                <div class="w-2/12">
                    <a class="text-4xl text-blue-500" href="{{ url()->previous() }}"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
                <div class="w-8/12 self-center">
                    <livewire:search-users>
                </div>
                <div class="w-2/12 self-center">
                    @auth
                        <div class="ml-2 block lg:hidden flex justify-end">
                            <button id="userButton"
                                    class="flex items-center focus:outline-none text-gray-600 hover:text-blue-500">
                                <a href="{{ route('user.profile', auth()->id()) }}"><img class="w-10 h-10 rounded-full" src="{{ \App\User::find(auth()->id())->avatar }}" alt="Avatar of User"></a>
                            </button>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    @endif
</header>
<main class="@if(isset($flip_wave) && $flip_wave == true) flip-wave @else {{ null }} @endif content">
    <div class="pt-5 pb-24 mb:pb-16 @if(isset($full_width) && $full_width == false) w-11/12 mx-auto @else w-full @endif @guest h-screen flex flex-col justify-center @endguest">
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
<script>
    var $body = jQuery('body');

    /* bind events */
    $(document)
        .on('focus', 'input', function() {
            $body.addClass('.fix-footer');
        })
        .on('blur', 'input', function() {
            $body.removeClass('.fix-footer');
        });
</script>
</body>
</html>
