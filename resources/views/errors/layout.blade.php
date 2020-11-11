<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body class="vh-100 bg-light">
<div class="d-flex flex-column justify-content-center text-left align-items-center h-100">
    <div style="font-size: 5rem" class="mb-3">
        @yield('code', __('Oh no'))
    </div>

    <div style="height: 5px; width: 100px" class="rounded-lg bg-primary mb-5"></div>

    <p class="text-grey-darker h2 font-weight-lighter text-muted mb-5 leading-normal">
        @yield('message')
    </p>

    <div class="w-50 border border-gray py-3 text-muted rounded-lg px-3 py-2 mb-5">
        <p class="text-dark">Rapport d'erreur :</p>
        <p class="mb-0">Navigateur : <span class="text-dark">{{ request()->header('user-agent') }}</span></p>
        <p class="mb-0">IP : <span class="text-dark">{{ request()->getClientIp() }}</span></p>
        <p class="mb-0">Connecté : <span class="text-dark">{{ auth()->check() === 0 ? 'Non' : 'Oui' }}</span></p>
    </div>

    <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
        <button class="btn btn-outline-primary btn-lg">
            {{ __('Retour à l\'accueil') }}
        </button>
    </a>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        @yield('image')
    </div>
</div>
</body>
</html>
