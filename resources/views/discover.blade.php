<x-page>
    <x-header>
        <x-slot name="title">Découvrir</x-slot>
        <x-slot name="subtitle">Espace permettant à quiconque de pouvoir créer et partager ses projets</x-slot>
        <x-slot name="description">
            <div class="row">
                @role('super-admin') <!-- Admin -->
                <div class="col-2">
                    <a class="btn-outline-primary" href="{{route('admin.index')}}">Administration</a>
                </div>
                @endrole

                <div class="col-2">
                    <a class="btn btn-outline-light" href="{{route('job.index')}}">Trouver un emploi</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-outline-light" href="{{route('formation.index')}}">Trouver une formation</a>
                </div>

                @role('company') <!-- Entreprise -->
                <div class="col-2">
                    <a class="btn btn-outline-light" href="{{route('job.create')}}">Proposer une offre d'emploi</a>
                </div>
                @endrole

                @role('school') <!-- Ecole -->
                <div class="col-2">
                    <a class="btn btn-outline-light" href="{{route('formation.create')}}">
                        Proposer une formation
                    </a>
                </div>
                @endrole
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="row">
                <div class="col-10">
                    <input id="search-users" type="search" placeholder="Rechercher parmis les utilisateurs..." class="form-control" name="search">
                </div>
                <div class="col text-center">
                    <button type="button" class="btn btn-link">Recherche avancée</button>
                </div>
            </div>
        </x-slot>
    </x-header>
    <!-- Offres d'emploi, proposer une formation etc. -->
    <x-container>
        <!-- Parties utilisateurs -->
        <div id="users-list" class="row mb-4">
            @foreach($users->items() as $user)
                <x-user.item :user="$user"></x-user.item>
            @endforeach
        </div>

        <x-element.load-more-button></x-element.load-more-button>

    </x-container>

    <x-slot name="script">
        <script type="text/javascript">
            let input = $('#search-users')

            $(input).keyup(function() {
                searchUsers()
            })

            function searchUsers(){
                $.ajax({
                    type : 'GET',
                    url: "{{ config('app.url') }}/discover/search?q=" + input.val(),
                    success : function(data) {
                        if (data.html.length === 0) {
                            $('#users-list').html(data.html);
                            $('#load-more').text("Aucun résultat").attr('disabled', true)
                        } else {
                            if(data.initial) {
                                $('#load-more').html("Voir plus").attr('disabled', false)
                                $('#users-list').html(data.html);
                            } else {
                                console.log(data.html.length)
                                let plural = data.html.length <= 1 ? '' : 's'

                                $('#load-more').text(data.html.length + " résultat" + plural).attr('disabled', true)
                                $('#users-list').html(data.html);
                            }
                        }
                    },
                })
            }
        </script>
        <script type="module">
            import { loadMoreData } from '{{ asset('js/ajax.js') }}'

            loadMoreData("{{ config('app.url') }}/discover", "users-list")
        </script>
    </x-slot>
</x-page>
