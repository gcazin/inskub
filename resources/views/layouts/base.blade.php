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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        ion-icon {
            visibility: visible;
        }
        #particles-js {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            height: 100%;
            width: 100%;
            z-index: 0;
        }
    </style>
    @yield('head')
</head>
<body style="background: #81b7ff29">

@include('partials.menu')

@auth
@endauth

@yield('content')
@auth
@endauth

@include('partials.footer')

@auth
    @include('partials.mobile-menu')
@endauth
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/js/bootstrap-select.min.js"></script>

<!-- Script -->
<script>
    let shareButton = document.querySelectorAll('.share-button');

    let i;

    document.querySelectorAll('.share-button').forEach(item => {
        item.addEventListener('click', e => {
            e.target.innerText = "Lien copié"

            setTimeout(function() {
                e.target.innerHTML = "<ion-icon class=\"align-text-bottom\" name=\"share-social-outline\"></ion-icon> Partager"
            }, 2500);
        })
    })

    function changeText(e) {
        e.target.innerText = "Lien copié"
    }
</script>
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
@livewireScripts
<script>
    $(document).ready(function() {
        let menu = $('#dropdown-sinistre')
        let item = $('#button-sinistre')

        menu.hide()

        item.click(function() {
            menu.toggle()
        })
    })
</script>
<script src="{{ asset('js/particles.min.js') }}"></script>
<script>
    particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}');
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
</html>
