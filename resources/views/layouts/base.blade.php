<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="icon" href="{{ asset('storage/images/favicon-96x96.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    @yield('head')
</head>
<body class="position-relative" style="background: #81b7ff29">

@auth
    @include('partials.menu')
@endauth

<div id="container" class="pb-10">

    @auth
        <div class="row no-gutters">
            @include('components.left-sidebar')
            @endauth

            @yield('content')
            @auth
        </div>
    @endauth
</div>

@auth
    @include('partials.mobile-menu')
@endauth
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        let search = $('#search-input')
        let searchMenu = $('#search-menu')

        $(search)
            .change(function() {
                if($(this).val() > 0) {
                    searchMenu.removeClass('d-none')
                }
            })
            .focusout(function() {
                searchMenu.addClass('d-none')
            })
    })

</script>
@yield('script')
</body>
</html>
