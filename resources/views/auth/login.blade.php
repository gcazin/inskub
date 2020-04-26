@extends('layouts.base', ['full' => true])

@section('content')
    <div class="row position-relative" style="height: 100vh">
        <div class="position-relative px-0 d-none d-lg-block col-lg-6" style="background: rgba(129, 183, 255, 0.85)">
            <svg class="position-absolute w-100" style="bottom: 0" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1"
                      d="M0,224L80,202.7C160,181,320,139,480,149.3C640,160,800,224,960,224C1120,224,1280,160,1360,128L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
            <div class="container w-75 h-100 d-flex flex-column align-items-center justify-content-center py-5">
                <img class="w-75" src="{{ asset('storage/images/authentication.svg') }}" alt="">
            </div>
        </div>
        <div class="col-lg-6 py-4 bg-white d-flex align-items-center justify-content-center" id="container-login-form">
            <svg class="position-fixed w-100 d-block d-lg-none" style="top: 0; transform: rotate(-180deg)"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#4299e1" fill-opacity="1"
                      d="M0,224L80,202.7C160,181,320,139,480,149.3C640,160,800,224,960,224C1120,224,1280,160,1360,128L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
            <svg class="position-fixed w-100 d-block d-lg-none" style="bottom: 0" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 1440 320">
                <path fill="#4299e1" fill-opacity="1"
                      d="M0,224L80,202.7C160,181,320,139,480,149.3C640,160,800,224,960,224C1120,224,1280,160,1360,128L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
            <div class="container rounded-lg" id="login-form" style="width: 85%">
                <h1 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-none d-lg-block">Connexion</h1>
                <h3 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-lg-none">Connexion</h3>
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
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
                <hr>
                <p>Pas encore inscrit? <a href="{{ route('register') }}">Inscrivez-vous</a></p>
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
