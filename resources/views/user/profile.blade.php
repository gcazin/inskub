@extends('layouts.base', ['full_width' => true])

@section('content')
    <x-container>

        <div class="mb-3 rounded">
            <div class="profile__banner">
                <img src="https://i.imgur.com/XNgxmzi.png" style="height: 100px; object-fit: cover" class="w-100 rounded-top" alt="">
            </div>
            <div class="d-flex justify-content-center bg-white" style="margin-top: -4rem">
                <img alt="avatar" src="{{ \App\User::getAvatar($user->id) }}"
                     class="rounded-circle border">
            </div>
            <div class="container rounded-bottom">
                <div class="row shadow-sm bg-white py-1">
                    <div class="col">

                        @if(auth()->id() === (int) request()->route('id'))
                            <div class="row">
                                <div class="col">
                                    <p class="h4">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</p>
                                </div>
                                <div class="col text-right">
                                    <a class="h4" href="{{ route('user.edit') }}">
                                        <ion-icon class="align-bottom text-xl" name="settings-outline"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        @else
                            <a class="text-xl" href="{{ route('chat.createConversation', $user->id) }}">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </a>
                        @endif
                        <p class="mb-3">
                            <a href="{{ route('user.follower', $user->id) }}">
                                {{ \App\User::getNumberFollowers(auth()->id()) }} abonnés
                            </a> -
                            <a href="{{ route('user.following', $user->id) }}">
                                {{ \App\User::getNumberFollowings(auth()->id()) }} abonnements
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <x-section class="mb-3">
            <div class="row">
                <div class="col">
                    <p>Lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem </p>
                </div>
                <div class="col text-right">
                    <button type="button" data-toggle="modal" data-target="#userAbout" class="btn btn-primary">Modifier la description</button>
                </div>
            </div>
            @if(auth()->user()->about !== null)
                {{ auth()->user()->about }}
            @else
                <button type="button" data-toggle="modal" data-target="#userAbout" class="btn btn-primary">Ajouter une description</button>
            @endif
        </x-section>

        <x-modal name="userAbout" title="Ajouter une description de profil">
            <x-form :action="route('user.profile', auth()->id())" name="about">
                <x-textarea label="Description" name="about"></x-textarea>
                <x-submit>Valider</x-submit>
            </x-form>
        </x-modal>

        <!-- Etudiants et salariés -->
    @if($user->role_id === 2 || $user->role_id === 5)
        <!-- Formations -->
            <x-section class="mb-3">
                <div class="card-header">
                    <h2 class="card-title">Formations</h2>
                    @if((int) request()->route('id') === (int) auth()->id())
                        <div class="card__header--button">
                            <a href="{{ route('user.formation.create') }}">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @include('user.partials.formations-list')
                </div>
            </x-section>

            <!-- Expériences -->
            <div class="w-11/12 mx-auto">
                <div class="card">
                    <div class="card__header flex items-center justify-between px-3 pt-2">
                        <div class="card__header--title">
                            <h2 class="text-xl text-gray-800">Expériences</h2>
                        </div>
                        @if((int) request()->route('id') === (int) auth()->id())
                            <div class="card__header--button">
                                <a href="{{ route('user.experience.create') }}">
                                    <ion-icon name="add-circle-outline"></ion-icon>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @include('user.partials.experiences-list')
                    </div>
                </div>
            </div>
    @endif

    <!-- Entreprise -->
    @if($user->role_id === 3)
            <x-about-user
                title="Emplois proposés"
                target="create-job">
                @include('user.partials.jobs-list')
            </x-about-user>

            <x-modal title="Publier une offre d'emploi" name="create-job">
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
            </x-modal>
    @endif

    <!-- Ecole -->
        @if($user->role_id === 4)
            <x-about-user
                title="Formations proposées"
                target="create-formation">
                @include('user.partials.formations-list')
            </x-about-user>

            <x-modal title="Ajouter une formation" name="create-formation">
                <x-form :action="route('user.formation.create')">

                    <x-input label="Ecole" name="school" placeholder="Université de ..."></x-input>
                    <x-input label="Diplôme" name="degree" placeholder="Licence ..."></x-input>
                    <x-input label="Domaine d'étude" name="study_area" placeholder="Assurance en ..."></x-input>

                    <div class="row">

                        <div class="col">
                            <x-input type="number" label="Date de début" name="start_date" :placeholder="now()->year-1"></x-input>
                        </div>
                        <div class="col">
                            <x-input type="number" label="Date de fin" name="finish_date" :placeholder="now()->year"></x-input>
                        </div>

                    </div>

                    <x-textarea label="Description" name="description" placeholder="Informations en plus..."></x-textarea>

                    <x-submit>Valider</x-submit>
                </x-form>
            </x-modal>
        @endif
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
