<x-page title="Inscription">
    <x-slot name="head">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-header>
        <x-slot name="title">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    Inscription
                </div>
            </div>
        </x-slot>
    </x-header>

    <x-container>
        <x-section class="col-lg-8 mx-auto" id="container-login-form">
            <div class="container rounded-lg" id="login-form">
                <x-form.item :action="route('register')" id="register-form">

                    <!-- Choix du rôle -->
                    <div class="row py-3 row-cols-2 row-cols-lg-3">
                        @foreach(\Spatie\Permission\Models\Role::all()->except([1,2]) as $role)
                            <div class="col-lg pb-1">
                                <div class="card text-center">
                                    <label for="{{ $role->name }}" class="position-absolute w-100 h-100"></label>
                                    <input type="radio" class="checkbox custom" name="role_name" id="{{ $role->name }}" value="{{ $role->name }}" {{ $role->name === "person" ? 'checked' : null }}>
                                    <div class="card-body rounded">
                                        <p class="card-text" style="font-size: 0.80rem">{{ __('roles.'.$role->name) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                {{--<x-element.alert type="info" id="alert-school-register">
                    <x-slot name="title">//</x-slot>
                </x-element.alert>--}}

                <!-- Identité -->
                    <div class="row row-cols-1 row-cols-lg-2">
                        <!-- Nom -->
                        <div class="col">
                            <x-form.input required label="Nom" name="last_name" placeholder="Dupont"></x-form.input>
                        </div>

                        <!-- Prénom -->
                        <div class="col">
                            <x-form.input label="Prénom" name="first_name" placeholder="Jean"></x-form.input>
                        </div>
                    </div>

                    <!-- Mail -->
                    <x-form.input type="email" label="Adresse e-mail" name="email" placeholder="dupont.jean@email.fr"></x-form.input>

                    <!-- Localisation -->
                    <div id="expert-container">
                        <!-- Département -->
                        <div class="form-group">
                            <label for="department_id" class="text-dark-400">Département</label>
                            <select class="departments form-control d-block" id="department_id" name="department_id">
                                @foreach(\App\Models\Department::all()->sortBy('code') as $department)
                                    <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Code postal et ville -->
                        <div class="row">

                            <!-- Code postal -->
                            <div class="col">
                                <x-form.input label="Code postal" name="postal_code" placeholder="Code postal"></x-form.input>
                            </div>

                            <!-- Ville -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">Ville</label>
                                    <select class="city form-control d-block" id="city" name="city_id"></select>
                                </div>
                            </div>
                        </div>

                        <!-- Périmètre -->
                        <div class="form-group">
                            <label for="perimeter" class="text-dark-400">Périmètre</label>
                            <div class="row no-gutters">
                                <div class="col mr-3">
                                    <input type="range" class="custom-range" min="0" max="30" step="1" name="perimeter" id="perimeter">
                                </div>
                                <span class="badge badge-primary h5">
                                    <span id="perimeter-value">0</span> km
                                </span>
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
                            <label for="company_id">Compagnie</label>
                            <select class="companies form-control d-block" id="company_id" name="company_id">
                                @foreach(\App\Models\Company::all()->sortBy('name') as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Fin localisation -->

                    <!-- Numéro de siret (intermédiaire) -->
                    <div class="form-group" id="siret-number-container">
                        <x-form.input label="Numéro de siret" name="siret_number" placeholder="Numéro de société"></x-form.input>
                    </div>

                    <!-- Mot de passe -->
                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="col">
                            <!-- Mot de passe -->
                            <x-form.input type="password" label="Mot de passe" name="password"></x-form.input>
                        </div>
                        <div class="col">
                            <!-- Confirmation du mot de passe -->
                            <x-form.input type="password" label="Confirmation du mot de passe" name="password_confirmation"></x-form.input>
                        </div>
                    </div>

                    <!-- Conditions générales -->
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
                //Intermediaire
                let siret_number = $('#siret-number-container')

                //Expert
                let expertContainer = $('#expert-container')
                let company = $('#company-container')
                let postal_code = $('#postal_code')
                let city = $('#city')

                $(company).hide()
                $(siret_number).hide()

                $(expertContainer).hide()

                $('#alert-school-register').removeClass('d-flex').addClass('d-none')

                $('input[name="role_name"]').click(function() {
                    if ($('input[value="expert"]').is(':checked')) {
                        $(expertContainer).show()
                        $(city).empty().append($('<option>', {
                            text: 'Renseigner votre code postal'
                        })).prop('disabled', true);

                        $(postal_code).change(() => {
                            $(city).empty()
                            $.ajax({
                                type: 'GET',
                                url: 'cities/' + $(postal_code).val(),
                                success: function (data) {
                                    $.each(data.html, function (i, item) {
                                        $(city).append($('<option>', {
                                            value: item.id,
                                            text: item.name
                                        }));
                                    })
                                    $(city).prop('disabled', false)
                                },
                                error: function (data) {
                                    console.log('Erreur: ' + data.html)
                                },
                            });
                        })
                    }
                    else {
                        $(company).hide()
                        $(expertContainer).hide()
                        $(city).hide()
                    }

                    if ($('input[value="intermediate"]').is(':checked')) {
                        $(siret_number).show()
                    } else {
                        $(siret_number).hide()
                    }

                    /*if ($('input[value="school"]').is(':checked')) {
                        $('#alert-school-register').addClass('d-flex').removeClass('d-none')
                    } else {
                        $('#alert-school-register').removeClass('d-flex').addClass('d-none')
                    }*/
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
        <script type="text/javascript">
            let range = $('#perimeter')
            let value = $('#perimeter-value')

            range.on('input', function(){
                $(value).html(this.value);
            });
        </script>
        <script src="{{ asset('js/particles.min.js') }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}');
        </script>
    </x-slot>
</x-page>
