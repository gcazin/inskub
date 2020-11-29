<x-page title="Découvrir">

    <x-header>
        <x-slot name="title">Découvrir</x-slot>
        <x-slot name="subtitle">Suivez les personnes qui vous intéressent</x-slot>
        <x-slot name="description">
            <p class="text-white-50">A la recherche d'une alternance ou d'un emploi ?</p>
            <div class="row no-gutters">
                <a class="btn btn-light mr-2" href="{{route('job.index')}}">
                    <x-element.icon name="business-outline"></x-element.icon>
                    Espace emplois
                </a>
                <a class="btn btn-light mr-2" href="{{route('formation.index')}}">
                    <x-element.icon name="school-outline"></x-element.icon>
                    Espace formations
                </a>

                @role('company') <!-- Entreprise -->
                    <a class="btn btn-outline-light mr-2" href="{{route('job.create')}}">Proposer une offre d'emploi</a>
                @endrole

                @role('school') <!-- Ecole -->
                <a class="btn btn-outline-light mr-2" href="{{route('formation.create')}}">Proposer une formation</a>
                @endrole
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="row">
                <div class="col-10">
                    <input id="search-users" type="search" placeholder="Rechercher parmis les utilisateurs..." class="form-control" name="search">
                </div>
                <div class="col text-center">
                    <button id="advanced-search" type="button" class="btn btn-link">Recherche avancée</button>
                </div>
            </div>
            <div class="mt-3" id="role-container">
                <p class="text-muted">Trier par rôle</p>
                @foreach($roles as $role)
                        <a href="?role={{ $role->name }}" class="btn btn-outline-primary mr-1">
                            {{ trans('roles.'.$role->name) }}
                        </a>
                @endforeach
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
        <script type="text/javascript">
            let button = $('#advanced-search')
            let container = $('#role-container')

            $(container).hide()
            $(button).click(function() {
                $(container).toggle()
            })
        </script>
        <script type="module">
            import { loadMoreData } from '{{ asset('js/ajax.js') }}'

            loadMoreData("{{ config('app.url') }}/discover", "users-list")
        </script>
    </x-slot>
</x-page>
