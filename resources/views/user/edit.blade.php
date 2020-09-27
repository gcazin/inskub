@extends('layouts.base')

@section('title')
    Modifier les informations du compte
@endsection

@section('content')
    <x-account-content title="Modifier des éléments de votre profil">

        <!-- Message d'alerte -->
        <div class="row">
            @if ($message = session()->get('success'))
                <x-alert type="success">
                    {{ $message }}
                </x-alert>
            @endif

            @if ($errors->any())
                <x-alert type="danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif
        </div>

        <!-- Formulaire -->
        <x-form :action="route('user.edit', auth()->id())" method="PUT" enctype>
            <div class="row mb-4">
                <div class="col-4 text-center">
                    <img class="rounded-circle" src="{{ \App\User::getAvatar($user->id) }}" alt="Avatar">
                </div>
                <div class="col">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="customFile">
                        <label class="custom-file-label" for="customFile">Choisir un nouveau avatar</label>
                    </div>
                </div>
            </div>
            <x-input label="Nom de famille" name="last_name" :value="$user->last_name"></x-input>
            <x-input label="Prénom" name="first_name" :value="$user->first_name"></x-input>
            <x-input type="email" label="Adresse e-mail" name="email" :value="$user->email"></x-input>
            <x-input type="password" label="Nouveau mot de passe" name="password"></x-input>
            <x-input type="password" label="Confirmation du nouveau mot de passe" name="password_confirmation"></x-input>

            <hr>
            <div class="text-right">
                <x-submit class="success">Sauvegarder</x-submit>
            </div>
        </x-form>

    </x-account-content>
@endsection
