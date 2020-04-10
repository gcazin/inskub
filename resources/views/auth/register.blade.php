@extends('layouts.base', ['title' => 'Inscription', 'full_width' => false])

@section('content')
    <div class="center-box flex-col lg:flex-row">
        <div class="flex-1 align-self-center">
            <img src="{{ asset('storage/images/authentication.svg') }}" class="w-6/12 m-auto">
        </div>
        <div class="flex-1">
            <h1 class="text-3xl mb-5">S'inscrire</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="role_id">Type de compte</label>
                    <select name="role_id" id="role_id" onchange="selectedValue()" autofocus>
                        @foreach(\App\Role::all()->except(1) as $role)
                            <option value="{{ $role->id }}" @if($role->id === 2) selected @endif>{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Pseudo') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
                </div>

                @error('name')
                <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse mail') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>

                @error('email')
                <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                    <input id="password" type="password" class="input" name="password" required autocomplete="new-password">
                </div>

                @error('password')
                <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirmation du mot de passe') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="departement">Département</label>
                    <select name="departement" id="departement" class="input">
                        @for($i = 0; $i < 101; $i++)
                            <option value="{{ $i }}" @if($i == 0) selected @endif>{{ $i }}</option>
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

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-blue">
                        {{ __('Créer votre compte') }}
                    </button>
                </div>
            </form>
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
            if(strUser == 3 || strUser == 4) {
                tel.classList.remove("hidden");
                tel.classList.add("block");

                adresse.classList.remove("hidden");
                adresse.classList.add("block");

                console.log('selectionné');
            } else {
                tel.classList.add("hidden");
                adresse.classList.add("hidden");
            }
        }
    </script>
@endsection
