<x-page title="Options">
    <x-header>
        <x-slot name="title">Informations du compte</x-slot>
        <x-slot name="content">
            <div class=" overflow-x-auto">
                <nav class="nav nav-pills nav-fill mb-3">
                    <a class="nav-item nav-link" href="{{ route('user.edit') }}">Modifier le profil</a>
                    <a class="nav-item nav-link" href="{{ route('user.options') }}">Options</a>
                </nav>
            </div>
        </x-slot>
    </x-header>

    <x-container>
        <x-section>
            <p class="h4">Changer vos préférences générales</p>
            <hr>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="visibility">
                    <label class="custom-control-label" for="visibility">Apparaitre dans les moteurs de recherche</label>
                </div>
            </div>
        </x-section>
    </x-container>
</x-page>
