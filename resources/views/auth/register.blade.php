@extends('layouts.base', ['full' => true])

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row position-relative" style="height: 100vh">
        <div class="position-relative px-0 d-none d-lg-block col-lg-6" style="background: rgba(129, 183, 255, 0.16)">
            <svg class="position-absolute w-100" style="bottom: 0" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1"
                      d="M0,224L80,202.7C160,181,320,139,480,149.3C640,160,800,224,960,224C1120,224,1280,160,1360,128L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
            <div class="container w-75 h-100 d-flex flex-column align-items-center justify-content-center py-5">
                <div id="carouselExampleIndicators"
                     class="carousel slide position-absolute h-100 w-100 d-flex align-items-center justify-content-center"
                     data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/images/job.svg') }}" class="d-block w-25 mx-auto" alt="...">
                            <div
                                class="carousel-caption w-75 position-relative mt-5 d-none d-md-block text-dark bg-white rounded-lg">
                                <h3>Bienvenue sur <span
                                        class="text-primary font-weight-normal">{{ env('APP_NAME') }}</span></h3>
                                <p>Texte de présentation</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/project.svg') }}" class="d-block w-25  mx-auto"
                                 alt="...">
                            <div
                                class="carousel-caption w-75 position-relative mt-5 d-none d-md-block text-dark bg-white rounded-lg">
                                <h3>Organiser vos <span class="text-primary font-weight-normal">projets</span></h3>
                                <p>Texte d'explication</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/organize.svg') }}" class="d-block w-25  mx-auto"
                                 alt="...">
                            <div
                                class="carousel-caption w-75 position-relative mt-5 d-none d-md-block text-dark bg-white rounded-lg">
                                <h3><span class="text-primary font-weight-normal">Collaborer</span> ensemble</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac quam porttitor,
                                    tempus lacus vitae, semper libero. Pellentesque venenatis luctus lacinia. Fusce
                                    interdum mauris nec enim interdum euismod vitae et ex.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 py-4 d-flex align-items-center justify-content-center" id="container-login-form">
            <div class="container rounded-lg" id="login-form" style="width: 85%">
                <h1 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-none d-lg-block">Inscrivez-vous</h1>
                <h3 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-lg-none">Inscrivez-vous</h3>
                <x-form :action="route('register')">

                    <!-- Choix du rôle -->
                    <div class="row py-3 row-cols-2 row-cols-lg-5">
                        <div class="col-12 col-lg pb-1">
                            <div class="card text-center">
                                <label for="role_id" class="position-absolute w-100 h-100"></label>
                                <input type="radio" class="checkbox custom" name="role_id" id="role_id" value="2">
                                <div class="card-body rounded">
                                    <h5 class="card-title">
                                        <ion-icon name="people-outline"></ion-icon>
                                    </h5>
                                    <p class="card-text" style="font-size: 0.80rem">Personne</p>
                                </div>
                            </div>
                        </div>
                        <div class="col pb-1 pr-1">
                            <div class="card text-center">
                                <label for="student" class="position-absolute w-100 h-100" ></label>
                                <input type="radio" class="checkbox custom" name="role_id" id="student" value="3">
                                <div class="card-body rounded">
                                    <h5 class="card-title">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </h5>
                                    <p class="card-text" style="font-size: 0.80rem">Intermédiaire</p>
                                </div>
                            </div>
                        </div>
                        <div class="col pb-1">
                            <div class="card text-center">
                                <label for="school" class="position-absolute w-100 h-100"></label>
                                <input type="radio" class="checkbox custom" name="role_id" id="school" value="4">
                                <div class="card-body rounded">
                                    <h5 class="card-title">
                                        <ion-icon name="school-outline"></ion-icon>
                                    </h5>
                                    <p class="card-text" style="font-size: 0.80rem">Ecole</p>
                                </div>
                            </div>
                        </div>
                        <div class="col pr-1">
                            <div class="card text-center">
                                <label for="enterprise" class="position-absolute w-100 h-100"></label>
                                <input type="radio" class="checkbox custom" name="role_id" id="enterprise"
                                       value="5">
                                <div class="card-body rounded">
                                    <h5 class="card-title">
                                        <ion-icon name="business-outline"></ion-icon>
                                    </h5>
                                    <p class="card-text" style="font-size: 0.80rem">Compagnie</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-center">
                                <label for="other" class="position-absolute w-100 h-100"></label>
                                <input type="radio" class="checkbox custom" name="role_id" id="other" value="6">
                                <div class="card-body rounded">
                                    <h5 class="card-title">
                                        <ion-icon name="git-network-outline"></ion-icon>
                                    </h5>
                                    <p class="card-text" style="font-size: 0.80rem">Autres</p>
                                </div>
                            </div>
                        </div>
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
                if ($('#student').is(':checked')) {
                    $(department).show()
                }
                if($('#enterprise').is(':checked')) {
                    $(company).show()
                }
                if(!$('#enterprise').is(':checked')) {
                    $(company).hide()
                }
                if(!$('#student').is(':checked')) {
                    $(department).hide()
                }
            });
        });
    </script>
@endsection
