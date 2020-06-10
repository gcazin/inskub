@extends('layouts.base')

@section('title')
    Projets
@endsection

@section('content')

    <x-container class="bg-white shadow-sm rounded">

        <x-section>

            <!-- Titre et bouton -->
            <div class="row mb-4">
                <div class="col-lg">
                    <h3 class="text-black-50">Projet(s)</h3>
                </div>
                <div class="col-lg text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-project">
                        <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un projet
                    </button>
                </div>

                <!-- Modal pour la création d'un projet -->
                <x-modal title="Création d'un nouveau projet" name="new-project">
                    <x-form :action="route('project.index')">
                        <div class="form-group">
                            <span>Type de projet</span>
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="public" value="0" name="private" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="public">Personnel</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="private" value="1" name="private" class="custom-control-input">
                                        <label class="custom-control-label" for="private">Professionnel</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-input label="Titre du projet" name="title" placeholder="Mon super projet" required></x-input>
                        <x-textarea label="Description" name="description" rows="3"></x-textarea>

                        <div class="form-group">
                            <label for="deadline">Date de fin</label>
                            <input type="text" class="form-control" id="deadline" name="deadline" data-toggle="datepicker" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="participants">Participant</label>
                            @if(count(auth()->user()->followings) > 0)
                                <select name="participants[]" class="form-control" id="participants" multiple>
                                    @foreach(auth()->user()->followings as $following)
                                        <option value="{{ $following->id }}">{{ $following->first_name }} {{ $following->last_name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <x-alert type="warning">
                                    Vous ne suivez personne pour l'instant
                                </x-alert>
                            @endif
                        </div>

                        <?php
                        $colours = [
                            '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50', '#f39c12', '#d35400', '#c0392b', '#bdc3c7', '#7f8c8d'
                        ]
                        ?>
                        <div class="form-group">
                            <p>Choix de la couleur</p>
                            <div class="row row-cols-lg-10 justify-content-between no-gutters">
                                @foreach($colours as $colour)

                                    <div class="col-1 pb-1 pr-lg-1">
                                        <label for="{{$colour}}" class="position-absolute w-100 h-100"></label>
                                        <input
                                            type="radio"
                                            class="checkbox custom"
                                            name="colour"
                                            id="{{$colour}}"
                                            value="{{$colour}}">
                                        <div class="card-body rounded p-1">
                                            <div
                                                class="rounded-circle shadow"
                                                style="background: {{$colour}}; width: 25px; height: 25px"></div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <x-submit>Créer le projet</x-submit>
                    </x-form>
                </x-modal>
            </div>

            <!-- Cartes -->
            <div class="row d-none d-lg-flex mb-4">
                <!-- Nombres de projet -->
                <div class="col-4 mb-2 mb-lg-0">
                    <div class="card py-3">
                        <div class="card-body px-0 pb-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-4 align-self-center text-center">
                                    <ion-icon class="mb-0 h1 text-primary" name="list-outline"></ion-icon>
                                </div>
                                <div class="col-8">
                                    <p class="h4 text-primary">{{ count($projects) }} projet(s)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projet terminé -->
                <div class="col-4 mb-2 mb-lg-0">
                    <div class="card py-3">
                        <div class="card-body px-0 pb-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-4 align-self-center text-center">
                                    <ion-icon class="mb-0 h1 text-success" name="checkmark-outline"></ion-icon>
                                </div>
                                <div class="col-8">
                                    <p class="h4 text-success">{{ count($projects->where('finish', 1)) }} terminé(s)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projets restant -->
                <div class="col-4 mb-2 mb-lg-0">
                    <div class="card py-3">
                        <div class="card-body px-0 pb-0 pt-2">
                            <div class="row no-gutters">
                                <div class="col-4 align-self-center text-center">
                                    <ion-icon class="mb-0 h1 text-danger" name="refresh-outline"></ion-icon>
                                </div>
                                <div class="col-8">
                                    <p class="h4 text-danger">{{ count($projects->where('finish', 0)) }} restant</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('project.show', $project->id) }}" class="position-absolute h-100 w-100" style="top: 0; bottom: 0; left: 0; right: 0"></a>
                    </div>
                </div>
            </div>

            <!-- Actions (rechercher, filter etc.) -->
            <div class="row mb-4">
                <div class="col-lg">
                    <input type="text" id="search-project" class="form-control" placeholder="Rechercher parmi la liste...">
                </div>
                <div class="col-lg text-lg-right my-2 my-lg-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <div class="dropdown">
                            <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="filter-outline"></ion-icon>
                                Filter par
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-light"><ion-icon name="funnel-outline"></ion-icon> Trier par</button>
                    </div>
                </div>
            </div>

            <!-- Catégories -->
            <div class="row mb-4 text-black-50 overflow-auto" style="font-size: 0.9rem">
                <div class="col col-lg-6">Titre</div>
                <div class="col col-lg-2">Participants</div>
                <div class="col col-lg-2">Statut</div>
                <div class="col col-lg-2 d-none d-lg-block">A rendre avant le</div>
            </div>

            <!-- Liste des projets -->
            <div class="row flex-column mb-4">
                @forelse($projects->sortBy('finish') as $project)
                    <div class="menu-item overflow-auto px-lg-3 py-3 position-relative" style="background: #F6FAFF">
                        <div class="row">
                            <div class="col col-lg-6 h5 text-secondary">
                                {{ $project->title }}
                            </div>
                            <div class="col col-lg-2">
                                @if(count(\App\Project::find($project->id)->users))
                                    @foreach(\App\Project::find($project->id)->users()->take(3)->get() as $participant)
                                        <img class="rounded-circle" style="height: 30px" src="{{ \App\User::getAvatar($participant->user_id) }}" alt="">
                                    @endforeach
                                @endif
                            </div>
                            <div class="col col-lg-2 h5">
                                @if($project->finish !== 0)
                                    <span class="badge badge-pill badge-success">Terminé</span>
                                @else
                                    <span
                                        class="badge badge-pill badge-{{ \App\Project::daysLeft($project, true) }}">
                                    {{ $carbon->parse($project->deadline)->formatLocalized('%d %b %Y') }}
                                </span>
                                @endif
                            </div>
                            <div class="col col-lg-2 d-none d-lg-block">
                           <span class="text-muted">
                                {{ \App\Project::daysLeft($project) }}
                           </span>
                            </div>
                            <a href="{{ route('project.show', $project->id) }}" class="position-absolute h-100 w-100" style="top: 0; bottom: 0; left: 0; right: 0"></a>
                        </div>
                    </div>
                @empty
                    <x-alert type="info">
                        Créer votre premier projet dès maintenant!
                    </x-alert>
                @endforelse
            </div>

        </x-section>

    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.fr-FR.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
                language: 'fr-FR',
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#search-project").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#project-list li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
