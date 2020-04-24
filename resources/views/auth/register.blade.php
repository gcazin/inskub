@extends('layouts.base', ['title' => 'Inscription', 'full_width' => false])

@section('content')
    <div class="text-center mb-5 ">
        <a href="{{ route('post.index') }}" class="font-medium text-gray-700 dark:text-gray-200">
            <img class="h-8 inline-block align-baseline" src="{{ asset('storage/images/logo.png') }}"
                 alt="Logo">
            <span class="text-3xl">TomorrowInsurance</span>
        </a>
    </div>
    <div class="container lg:w-5/12 overflow-auto">
        <h1 class="text-2xl text-gray-600 mb-3">Inscription</h1>
        <div class="card flex flex-col lg:flex-row">
            <div class="flex-1">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="role_id">Type de compte</label>
                        <select name="role_id" id="role_id" onchange="selectedValue()" autofocus required>
                            @foreach(\App\Role::all()->except(1) as $role)
                                <option value="{{ $role->id }}" @if($role->id === 2) selected @endif>{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="last_name">{{ __('Nom') }}</label>
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                    </div>

                    <div class="form-group">
                        <label for="first_name">{{ __('Prénom') }}</label>
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                    </div>


                    <div class="form-group">
                        <label for="email">{{ __('Adresse mail') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Mot de passe') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirmation du mot de passe') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required>
                    </div>

                    <div class="form-group hidden" id="departement-container">
                        <label for="departement">Département</label>
                        <select name="departement" id="departement" class="input" required>
                            <option disabled selected>Choisir votre département</option>
                            @for($i = 0; $i < 101; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group hidden" id="tel-container">
                        <label for="tel">Téléphone</label>
                        <input type="text" name="tel" id="tel" class="input" placeholder="Numéro de téléphone">
                    </div>

                    <div class="form-group hidden" id="adresse-container">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" id="adresse" class="input" placeholder="Adresse">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue btn-block">
                            {{ __('Créer votre compte') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-3">
            <p class="mt-3">Déjà un compte? <a class="text-blue-700" href="{{ route('login') }}">Connectez-vous</a></p>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function selectedValue() {
            let e = document.getElementById("role_id");
            let strUser = e.options[e.selectedIndex].value;
            let tel = document.getElementById('tel-container');
            let adresse = document.getElementById('adresse-container');
            let departement = document.getElementById('departement-container');
            if(strUser == 3 || strUser == 4) {
                tel.classList.remove("hidden");
                tel.classList.add("block");

                adresse.classList.remove("hidden");
                adresse.classList.add("block");

                departement.classList.remove("hidden");
                departement.classList.add("block");

                console.log('selectionné');
            } else {
                tel.classList.add("hidden");
                adresse.classList.add("hidden");
                departement.classList.add("hidden");
            }
        }
    </script>
@endsection
