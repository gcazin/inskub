@extends('layouts.base', ['header' => false])

@section('content')

    <!-- Formations -->
    <x-container>
        <h2 class="text-black-50 mb-4">Détails</h2>
        <x-section>

            <div class="row pb-3">
                <div class="col-lg-4">
                    <span class="text-muted">Nom de la formation</span>
                </div>
                <div class="col-lg-6">
                    <span>{{ $formation->title }}</span>
                </div>
            </div>

            <div class="row py-3">
                <div class="col-lg-4">
                    <span class="text-muted">Lieu</span>
                </div>
                <div class="col-lg-6">
                    <span>{{ $formation->location }}</span>
                </div>
            </div>

            <div class="row py-3">
                <div class="col-lg-4">
                    <span class="text-muted">Prix d'entrée</span>
                </div>
                <div class="col-lg-6">
                    <span>{{ $formation->entry_price ? $formation->entry_price.'€' : 'Prix d\'entrée non spécifié' }}</span>
                </div>
            </div>

            <div class="row py-3">
                <div class="col-lg-4">
                    <span class="text-muted">Description</span>
                </div>
                <div class="col-lg-6">
                    <span>{{ $formation->description }}</span>
                </div>
            </div>

            <div class="row py-3">
                <div class="col-lg-4">
                    <span class="text-muted">Prendre contact</span>
                </div>
                <div class="col-lg-6">
                    <a target="_blank" class="btn btn-primary" href="mailto:{{ \App\User::find($formation->user_id)->email }}">Postuler</a>
                </div>
            </div>

        </x-section>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection
