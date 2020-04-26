@extends('layouts.base', ['full' => true])

@section('content')
    <div class="row" style="height: 100vh">
        <div class="position-relative col-lg-6 bg-primary d-flex align-items-center justify-content-center border-left border-dark">
            <div id="particles-js" class="position-absolute w-100 h-100"></div>
            <div class="container">
                <div class="text-center">
                    <h1 class="text-white">Bienvenue sur TomorrowInsurance</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="container">
                <h1 class="text-primary mb-4">Inscription</h1>
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

                    <div class="row">
                        <div class="col-3">
                            <div class="custom-checkbox position-relative">
                                <input type="checkbox" class="hide" name="" id="test">
                                <label for="test">Salarié</label>
                            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" name="last_name" class="form-control border-0" placeholder="Nom de famille">
                        </div>

                        <div class="col">
                            <input type="text" name="first_name" class="form-control" placeholder="Prénom">
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Adresse e-mail">
                    </div>
                    <div class="form-group">
                        <input type="text" name="password" class="form-control" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <input type="text" name="confirm-password" class="form-control" placeholder="Confirmation du mot de passe">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role_id" id="role_id">
                            <option disabled selected>Choisir votre type de compte</option>
                            @foreach(\App\Role::all()->except(1) as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
                <hr>
                <p>Déjà un compte? <a href="{{ route('register') }}">Connectez-vous</a></p>
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
