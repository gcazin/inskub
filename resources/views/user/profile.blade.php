@extends('layouts.base', ['full_width' => true])

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
@endsection

@section('content')
    <x-container>

        <div class="mb-3 rounded">
            <div class="profile__banner">
                <img src="https://i.imgur.com/XNgxmzi.png" style="height: 100px; object-fit: cover" class="w-100 rounded-top" alt="">
            </div>
            <div class="d-flex justify-content-center bg-white" style="margin-top: -4rem">
                <img alt="avatar" src="{{ $user::getAvatar($user->id) }}" class="rounded-circle border">
            </div>
            <div class="container rounded-bottom">
                <div class="row shadow-sm bg-white py-1">
                    <div class="col">

                        <div class="row">
                            <div class="col">
                                <p class="h4">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</p>
                            </div>
                            <div class="col text-right">
                                @if(auth()->id() === (int) $user->id)
                                    <a class="h4" href="{{ route('user.edit') }}">
                                        <ion-icon class="align-bottom" name="settings-outline"></ion-icon>
                                    </a>
                                @else
                                    <a class="h4" href="{{ route('chat.createConversation', $user->id) }}">
                                        <ion-icon class="align-bottom" name="chatbubble-outline"></ion-icon>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <p class="mb-3">
                            <a href="{{ route('user.follower', $user->id) }}">
                                {{ auth()->user()->followers->count() }} abonnés
                            </a> -
                            <a href="{{ route('user.following', $user->id) }}">
                                {{ auth()->user()->followings->count() }} abonnements
                            </a>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <x-about-user
            title="A propos"
            target="userAbout">
            @isset($user->about)
                {{ $user->about }}
            @else
                <x-alert type="info">
                    Aucune description renseignée
                </x-alert>
            @endisset
        </x-about-user>

        <x-about-user
            title="Dernières publications">

            @forelse(\App\Post::where('user_id', $user->id)->take(5)->get() as $post)
                <div class="job-post border rounded p-3 mb-3">
                    <div class="row">
                        <div class="col">
                            <p class="font-bold">
                                {{ $post->content }}
                            </p>
                        </div>
                        <div class="col h5 text-right">
                <span class="badge badge-primary">
                    {{ $post->created_at->diffForHumans() }}
                </span>
                        </div>
                    </div>
                </div>
                @if($loop->last)
                    <div class="text-center">
                        <a href="{{ $post }}" class="btn btn-primary mx-auto">Voir toutes les publications</a>
                    </div>
                @endif
            @empty
                <x-alert type="info">
                    Aucune publication à afficher
                </x-alert>
            @endforelse

        </x-about-user>

        @if((int) auth()->id() === (int) request()->id)
            <x-modal title="Ajouter une expérience" name="userAbout">
                <x-form :action="route('user.profile', auth()->id())">
                    <x-textarea label="Description" name="about"></x-textarea>

                    <x-submit>Valider</x-submit>
                </x-form>
            </x-modal>
        @endif

    <!-- Etudiants et salariés -->
        @if($user->role_id === 2 || $user->role_id === 5)
        <!-- Expériences -->
            <x-about-user
                title="Expériences"
                target="create-experience">
                @include('user.partials.experiences-list')
            </x-about-user>

            <x-modal title="Ajouter une expérience" name="create-experience">
                <x-form :action="route('user.experience.create')" method="post">

                    <x-input label="Titre" name="title" placeholder="Intitulé du poste"></x-input>
                    <x-input label="Entreprise" name="enterprise" placeholder="Entreprise concernée..."></x-input>
                    <x-input label="Localisation" name="location" placeholder="Paris..."></x-input>
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

            <!-- Formations -->
            <x-about-user
                title="Formations"
                target="create-formation">
                @include('user.partials.formations-list')
            </x-about-user>

            <x-modal title="Ajouter une formation" name="create-formation">
                <x-form :action="route('user.formation.create')" method="post">

                    <x-input label="Ecole" name="school" placeholder="Université de..." required></x-input>
                    <x-input label="Diplôme" name="degree" placeholder="Licence..."></x-input>
                    <x-input label="Domaine d'étude" name="study_area" placeholder="Assurance en..."></x-input>
                    <div class="row">
                        <div class="col">
                            <x-input label="Date de début" name="start_date" :placeholder="now()->year-1"></x-input>
                        </div>

                        <div class="col">
                            <x-input label="Date de fin" name="finish_date" :placeholder="now()->year"></x-input>
                        </div>
                    </div>
                    <x-textarea label="Description" name="description" placeholder="..."></x-textarea>
                    <x-submit>Valider</x-submit>
                </x-form>
            </x-modal>
        @endif

    <!-- Entreprise -->
        @if($user->role_id === 3)
        <!-- Emplois -->
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
        <!-- Formations -->
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

        <x-about-user
            title="Compétences"
            target="create-skill">
            @include('user.partials.skills-list')
        </x-about-user>

        <x-modal title="Ajouter une compétence" name="create-skill">
            <x-form :action="route('user.skill.create')" method="post">
                <x-input label="Titre" name="title" placeholder="Intitulé de la compétence"></x-input>
                <x-submit>Valider</x-submit>
            </x-form>
        </x-modal>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
