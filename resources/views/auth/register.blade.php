@extends('layouts.base')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div id="particles-js"></div>
    <div class="row position-absolute w-100" style="left: 50%; top: 50%; transform: translate(-50%, -50%)">
        <div class="col-lg-6 mx-auto py-4 d-flex align-items-center align-content-center justify-content-center shadow-sm rounded" id="container-login-form">
            <div class="container rounded-lg" id="login-form">
                <h1 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-none d-lg-block">Inscrivez-vous</h1>
                <h3 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-lg-none">Inscrivez-vous</h3>
                <x-form :action="route('register')">

                    <!-- Choix du rôle -->
                    <div class="row py-3 row-cols-2 row-cols-lg-3">
                        @foreach(collect(\Spatie\Permission\Models\Role::all()->except([1,2])) as $role)
                            <div class="col-lg pb-1">
                                <div class="card text-center">
                                    <label for="{{ $role->name }}" class="position-absolute w-100 h-100"></label>
                                    <input type="radio" class="checkbox custom" name="role_id" id="{{ $role->name }}" value="{{ $role->id }}">
                                    <div class="card-body rounded">
                                        <p class="card-text" style="font-size: 0.80rem">{{ ucfirst($role->name) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Identité -->
                    <div class="form-group">
                        <div class="row row-cols-1 row-cols-lg-2">

                            <!-- Nom -->
                            <div class="col">
                                <div class="input-group mb-3 mb-lg-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <ion-icon name="person-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" placeholder="Nom" autofocus value="{{ old('last_name') }}">
                                </div>
                            </div>

                            <!-- Prénom -->
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <ion-icon name="person-outline"></ion-icon>
                                        </span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" placeholder="Prénom"
                                           aria-label="Adresse e-mail" aria-describedby="basic-addon1" value="{{ old('first_name') }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Mail -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Adresse e-mail"
                                   aria-label="Adresse e-mail" aria-describedby="basic-addon1" value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Departement -->
                    <div class="form-group" id="department-container">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="location-outline"></ion-icon>
                            </span>
                            </div>
                            <select class="departments form-control d-block" id="department" name="department">
                                @foreach(\App\Department::all()->sortBy('code') as $department)
                                    <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Compagnie -->
                    <div class="form-group" id="company-container">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="location-outline"></ion-icon>
                            </span>
                            </div>
                            <select class="companies form-control d-block" id="company" name="company">
                                @foreach(\App\Company::all()->sortBy('name') as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col">
                                <!-- Mot de passe -->
                                <div class="input-group mb-3 mb-lg-0">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <ion-icon name="lock-closed-outline"></ion-icon>
                                            </span>
                                    </div>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Mot de passe" aria-label="Mot de passe"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col">
                                <!-- Confirmation du mot de passe -->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <ion-icon name="lock-closed-outline"></ion-icon>
                                            </span>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmation du mot de passe">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">J'ai lu et j'accepte les conditions
                            générales d'utilisation.</label>
                    </div>

                    <x-submit>S'inscrire</x-submit>
                </x-form>
                <hr>
                <p>Déjà inscrit? <a href="{{ route('login') }}">Connectez-vous</a></p>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            /*$('.departments').select2();*/
        });
    </script>
    {{--<script src="{{ asset('js/particles.min.js') }}"></script>
    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}', function () {
            console.log('callback - particles.js config loaded');
        });
    </script>--}}
    <script>
        $(document).ready(function() {
            let department = $('#department-container')

            let company = $('#company-container')

            $(department).hide()
            $(company).hide()
            $('input[name="role_id"]').click(function() {
                if ($('input[value="4"]').is(':checked')) {
                    $(company).show()
                    $(department).show()
                }
                else {
                    $(company).hide()
                    $(department).hide()
                }
            });
        });
    </script>
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script>
        particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}');
    </script>
@endsection
