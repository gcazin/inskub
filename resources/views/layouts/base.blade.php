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
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
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
<body class="position-relative" style="background: #81b7ff29">

@auth
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
    <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="#"><img style="width: 50px" src="{{ asset('storage/images/logo.png') }}" alt="">TomorrowInsurance</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Découvrir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Projets</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><ion-icon class="h4 align-middle" name="chatbubbles-outline"></ion-icon></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><ion-icon class="h4 align-middle" name="notifications-outline"></ion-icon></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-fluid rounded-circle" style="height: 30px;" src="{{ \App\User::getAvatar(auth()->id()) }}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endauth

<div class="@if(isset($full)) container-fluid @else container @endif" @if(isset($full) && !$full) style="width: 50%" @endif>
        @yield('content')
</div>

@include('partials.mobile-menu')

<script src="{{ asset('js/index.js') }}"></script>
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
