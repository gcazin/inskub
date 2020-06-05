@extends('layouts.base')

@section('content')
    <div class="w-11/12 lg:w-8/12 mx-auto">
        <h1 class="text-xl mb-2 text-gray-800">Ajouter une expérience</h1>

        <!-- Form -->
        <x-form :action="route('user.experience.create')" method="post">

            <x-input label="Titre" name="title" placeholder="Intitulé du poste"></x-input>
            <x-input label="Entreprise" name="enterprise" placeholder="Entreprise concernée..."></x-input>
            <x-input label="Localisation" name="location" placeholder="Paris..."></x-input>
            <x-input label="Secteur" name="sector" placeholder="Assurance..."></x-input>
            <x-input label="Secteur" name="sector" placeholder="Assurance..."></x-input>

            <div class="row">
                <div class="col">
                    <x-input label="Date de début" name="start_date" :placeholder="now()->year-1"></x-input>
                </div>

                <div class="col">
                    <x-input label="Date de fin" name="finish_date" :placeholder="now()->year"></x-input>
                </div>
            </div>

            <x-input label="Description" name="description" placeholder="Informations en plus..."></x-input>

            <x-submit>Valider</x-submit>
        </x-form>

        <div class="mt-5">
            @include('user.partials.experiences-list')
        </div>
    </div>
@endsection
