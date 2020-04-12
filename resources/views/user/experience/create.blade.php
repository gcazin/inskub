@extends('layouts.base')

@section('content')
    <div class="w-11/12 lg:w-8/12 mx-auto">
        <h1 class="text-xl mb-2 text-gray-800">Ajouter une expérience</h1>
        <div class="card">

            <!-- Form -->
            <div class="card__body px-3 py-2">
                <form action="{{ route('user.experience.create') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" placeholder="Intitulé du poste">
                    </div>

                    <div class="form-group">
                        <label for="enterprise">Entreprise</label>
                        <input type="text" name="enterprise" id="enterprise" placeholder="Entreprise concernée...">
                    </div>

                    <div class="form-group">
                        <label for="location">Localisation</label>
                        <input type="text" name="location" id="location" placeholder="Paris...">
                    </div>

                    <div class="form-group">
                        <label for="sector">Secteur</label>
                        <input type="text" name="sector" id="sector" placeholder="Assurance...">
                    </div>

                    <div class="flex">
                        <div class="form-group flex-1">
                            <label for="start_date">Date de début</label>
                            <input type="number" name="start_date" id="start_date" placeholder="{{ now()->year-1 }}">
                        </div>

                        <div class="form-group flex-1 ml-3">
                            <label for="finish_date">Date de fin</label>
                            <input type="number" name="finish_date" id="finish_date" placeholder="{{ now()->year }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" placeholder="Informations en plus...">
                    </div>

                    <div class="text-right">
                        <button class="btn btn-blue" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-5">
            @include('user.partials.experiences-list')
        </div>
    </div>
@endsection
