<x-page>
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.20.0/dist/tagify.min.css">
    </x-slot>

    <x-header>
        <x-slot name="title">Projet</x-slot>
        <x-slot name="subtitle">Espace permettant à quiconque de pouvoir créer et partager ses projets</x-slot>
        <x-slot name="description">
            <div class="container mx-0 px-0">
                <div class="row no-gutters">
                    <div class="col-2">
                        <p class="h5 text-white-50">Total</p>
                        <p class="h1 text-white">{{ $projects->count() }}</p>
                    </div>
                    <div class="col-2">
                        <p class="h5 text-white-50">En cours</p>
                        <p class="h1 text-white">{{ $projects->where('finish', '0')->count() }}</p>
                    </div>
                    <div class="col">
                        <p class="h5 text-white-50">Terminés</p>
                        <p class="h1 text-white">{{ $projects->where('finish', 1)->count() }}</p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="row">
                <div class="col-10">
                    <input id="search-users" type="search" placeholder="Rechercher parmis les projets..." class="form-control" name="search">
                </div>
                <div class="col text-center">
                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target=".new-project">
                        <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un projet
                    </button>
                </div>

                <x-element.modal title="Création d'un nouveau projet" name="new-project">
                    <x-form.item :action="route('project.index')">

                        <!-- Type de projet -->
                        <div class="form-group">
                            <span>Type de projet</span>
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="private" value="0" name="private" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="private">Personnel</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pro" value="1" name="private" class="custom-control-input">
                                        <label class="custom-control-label" for="pro">{{ auth()->user()->role_id === 4 ? 'Classe' : 'Professionnel' }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Titre -->
                        <x-form.input label="Titre du projet" name="title" placeholder="Mon super projet" required></x-form.input>
                        <x-form.textarea label="Description" name="description" rows="3"></x-form.textarea>

                        <!-- Deadline -->
                        <div class="form-group">
                            <label for="deadline">Date de fin</label>
                            <input type="text" class="form-control" id="deadline" name="deadline" data-toggle="datepicker" autocomplete="off">
                        </div>

                        <!-- Participants -->
                        <div class="form-group" id="participants-container">
                            <label for="participants">Participant</label>
                            @if(auth()->user()->getRoleNames()->contains('school'))
                                <x-form.textarea
                                    name="participants"
                                    help="Vous pouvez ajouter l'adresse email des élèves en appuyant sur la touche entrée"
                                    rows="5"></x-form.textarea>
                            @else
                                @if(count(auth()->user()->followings) > 0)
                                    @foreach(auth()->user()->followings as $following)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="participants[]" class="custom-control-input" id="following-{{ $following->id }}" value="{{ $following->id }}">
                                            <label class="custom-control-label" for="following-{{ $following->id }}">{{ $following->first_name }} {{ $following->last_name }}</label>
                                        </div>
                                    @endforeach
                                @else
                                    <x-element.alert type="warning">
                                        <x-slot name="title">
                                            Vous ne suivez personne pour l'instant
                                        </x-slot>
                                    </x-element.alert>
                                @endif
                            @endif
                        </div>

                        <hr>
                        <x-form.submit>Créer le projet</x-form.submit>
                    </x-form.item>
                </x-element.modal>
            </div>
        </x-slot>
    </x-header>

    <!-- Espace projet -->
    <x-container>

        <!-- Actions (rechercher, filter etc.) -->
        <div class="row mb-4">
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
            <div class="col col-lg-2 d-none d-lg-block"> </div>
        </div>

        <!-- Liste des projets -->
        <div class="container-fluid mx-0 px-0">
            <div class="row">
                <div class="col flex-wrap" id="project-list">
                    @forelse($projects->sortBy('finish') as $project)
                        <x-project.item :project="$project"></x-project.item>
                    @empty
                        <x-element.alert type="info">
                            <x-slot name="title">
                                Créer votre premier projet dès maintenant!
                            </x-slot>
                        </x-element.alert>
                    @endforelse
                </div>
            </div>
        </div>
    </x-container>

    <x-slot name="script">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.fr-FR.min.js"></script>
        <script>
            $(document).ready(function() {
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
                    $("#project-list .menu-item").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                let participants = $('#participants-container')
                participants.hide()

                $('input[name="private"]').click(function() {
                    if ($('#private').is(':checked')) {
                        console.log('salut')
                        $(participants).hide()
                    }
                    if($('#pro').is(':checked')) {
                        $(participants).show()
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.20.0/dist/tagify.min.js"></script>
        <script>
            let input = document.querySelector('textarea[name="participants"]')

            let tagify = new Tagify(input)
        </script>
    </x-slot>

</x-page>
