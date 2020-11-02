<x-page>
    <x-slot name="head">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-container>
        <x-section class="col-lg-8 mx-auto" id="container-login-form">
            <div class="container rounded-lg" id="login-form">
                <h1 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-none d-lg-block">Inscrivez-vous</h1>
                <h3 class="font-weight-light mb-1 mb-lg-4 mt-3 mt-lg-0 d-lg-none">Inscrivez-vous</h3>
                <x-form.item :action="route('register')">

                    <!-- Choix du rôle -->
                    <div class="row py-3 row-cols-2 row-cols-lg-3">
                        @foreach(\Spatie\Permission\Models\Role::all()->except([1,2]) as $role)
                            <div class="col-lg pb-1">
                                <div class="card text-center">
                                    <label for="{{ $role->name }}" class="position-absolute w-100 h-100"></label>
                                    <input type="radio" class="checkbox custom" name="role_name" id="{{ $role->name }}" value="{{ $role->name }}">
                                    <div class="card-body rounded">
                                        <p class="card-text" style="font-size: 0.80rem">{{ __('roles.'.$role->name) }}</p>
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
                            <select class="departments form-control d-block" id="department_id" name="department_id">
                                @foreach(\App\Models\Department::all()->sortBy('code') as $department)
                                    <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Compagnie -->
                    <div class="form-group" id="agreed-container">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="agreed_expert" id="agreed_expert">
                            <label class="custom-control-label" for="agreed_expert">Je suis agrée(e)</label>
                        </div>
                    </div>

                    <div class="form-group" id="company-container">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="location-outline"></ion-icon>
                            </span>
                            </div>
                            <select class="companies form-control d-block" id="company_id" name="company_id">
                                @foreach(\App\Models\Company::all()->sortBy('name') as $company)
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

                    <x-form.submit>S'inscrire</x-form.submit>
                </x-form.item>
                <hr>
                <p>Déjà inscrit? <a href="{{ route('login') }}">Connectez-vous</a></p>
            </div>
        </x-section>
    </x-container>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                let department = $('#department-container')
                let company = $('#company-container')
                let agreed_expert = $('#agreed-container')

                $(department).hide()
                $(agreed_expert).hide()
                $(company).hide()

                $('input[name="role_name"]').click(function() {
                    if ($('input[value="intermediate"]').is(':checked')) {
                        $(agreed_expert).show()
                        $(department).show()
                    }
                    else {
                        $(company).hide()
                        $(department).hide()
                        $(agreed_expert).hide()
                    }
                });

                $('input[name="agreed_expert"]').click(function() {
                    if($(this).is(':checked')) {
                        $(company).show()
                    } else {
                        $(company).hide()
                    }
                })
            });
        </script>
        <script src="{{ asset('js/particles.min.js') }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}');
        </script>
    </x-slot>
</x-page>
