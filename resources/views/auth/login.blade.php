@extends('layouts.base', ['full' => true])

@section('content')
    <div id="particles-js"></div>
    <div class="row position-absolute w-100" style="left: 50%; top: 50%; transform: translate(-50%, -50%)">
        <div class="col-lg-6 col-12 mx-auto py-4 shadow-sm rounded-lg" id="container-login-form">
            <div class="container" id="login-form">
                <h1 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-none d-lg-block">Connexion</h1>
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Des erreurs se sont produites lors de la saisie de vos informations
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                <!-- Mail -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Adresse e-mail"
                                   aria-label="Adresse e-mail" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <!-- Mail -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                                   aria-label="Mot de passe" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Se souvenir de moi?</label>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
                <hr>
                <p>Pas encore de compte? <a href="{{ route('register') }}">Inscrivez-vous</a></p>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/particles.min.js') }}"></script>

    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}', function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
@endsection
