<x-page title="Projets">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.20.0/dist/tagify.min.css">
    </x-slot>

    <x-header>
        <x-slot name="title">Sinistres</x-slot>
        <x-slot name="subtitle">Espace permettant de retrouver les projets d'expertise</x-slot>
        <x-slot name="description">
            <div class="container mx-0 px-0">
                <div class="row no-gutters">
                    <div class="col-4 col-lg-2">
                        <p class="h5 text-white-50">Total</p>
                        <p class="h1 text-white">{{ $projects->count() }}</p>
                    </div>
                    <div class="col-4 col-lg-2">
                        <p class="h5 text-white-50">En cours</p>
                        <p class="h1 text-white">{{ $projects->where('finish', '0')->count() }}</p>
                    </div>
                    <div class="col-4 col">
                        <p class="h5 text-white-50">Terminés</p>
                        <p class="h1 text-white">{{ $projects->where('finish', 1)->count() }}</p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="row">
                <div class="col-lg-10 mb-3 mb-lg-0">
                    <input id="search-users" type="search" placeholder="Rechercher parmis les sinistres..." disabled class="form-control" name="search">
                </div>
                <div class="col-lg">
                    <a href="{{ route('project.sinister.pdf-list') }}" class="btn btn-primary btn-block">Compte-rendu</a>
                </div>
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
