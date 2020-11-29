<x-page>
    <x-header>
        <x-slot name="title">Informations du compte</x-slot>
        <x-slot name="content">
            <div class=" overflow-x-auto">
                <nav class="nav nav-pills nav-fill">
                    <a class="nav-item nav-link" href="{{ route('user.edit') }}">Modifier le profil</a>
                    <a class="nav-item nav-link" href="{{ route('user.options') }}">Options</a>
                </nav>
            </div>
        </x-slot>
    </x-header>

    <x-container>
        <x-section>
            <p class="h4">Modifier des éléments de votre profil</p>
            <hr>
            <!-- Message d'alerte -->

            <!-- Formulaire -->
            <x-form.item :action="route('user.edit', auth()->id())" method="PUT" enctype>
                <div class="row mb-4">
                    <div class="col-4 text-center">
                        <img class="rounded-circle w-25" src="{{ auth()->user()->getAvatar($user->id) }}" alt="Avatar">
                    </div>
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="customFile">
                            <label class="custom-file-label" for="customFile">Choisir un nouveau avatar</label>
                        </div>
                    </div>
                </div>
                <x-form.input label="Nom de famille" name="last_name" :value="$user->last_name"></x-form.input>
                <x-form.input label="Prénom" name="first_name" :value="$user->first_name"></x-form.input>
                <x-form.input type="email" label="Adresse e-mail" name="email" :value="$user->email"></x-form.input>
                <x-form.input type="password" label="Nouveau mot de passe" name="password"></x-form.input>
                <x-form.input type="password" label="Confirmation du nouveau mot de passe" name="password_confirmation"></x-form.input>

                <hr>
                <x-form.submit>Sauvegarder</x-form.submit>
            </x-form.item>
        </x-section>
    </x-container>

</x-page>
