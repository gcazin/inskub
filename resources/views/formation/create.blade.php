@extends('layouts.base', ['full_width' => false, 'header' => false])

@section('content')
    <x-container>
        <h1 class="text-xl text-gray-700 mb-2">Publier une formation</h1>
        <x-section>
            <x-form :action="route('formation.create')">
                <x-input label="Titre de votre formation" name="title" placeholder="Chef de projet..." required></x-input>


                <x-textarea label="Description" name="description" placeholder="..." required></x-textarea>

                <x-input label="Localisation" name="location" placeholder="Paris"></x-input>

                <x-input type="number" label="Prix d'entrée" name="entry_price" placeholder="1300" required></x-input>

                <x-submit>Publier</x-submit>
            </x-form>
        </x-section>
    </x-container>
@endsection
