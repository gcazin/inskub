@extends('layouts.base')

@section('title')
    Découvrir
@endsection

@section('content')

    <x-header>
        <x-slot name="title">Découvrir</x-slot>
        <x-slot name="subtitle">Espace permettant à quiconque de pouvoir créer et partager ses projets</x-slot>
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
        <div class="card-body">
            {{--@if(auth()->user()->role_id === 1) <!-- Admin -->
                <a class="block {{ (request()->is('admin')) ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    Administration
                </a>
            @elseif(auth()->user()->role_id === 2 || auth()->user()->role_id === 5) <!-- Salarié et étudiant -->
                <div class="flex">
                    <a class="btn btn-primary btn-block" href="{{ route('job.index') }}">Emploi</a>
                    <a href="{{ route('formation.index') }}" class="btn btn-primary btn-block">Trouver une formation</a>
                </div>
            @elseif(auth()->user()->role_id === 3) <!-- Entreprise -->
                <a class="btn btn-primary btn-block" href="{{ route('job.create') }}">
                    <ion-icon class="align-text-bottom h4" name="add-outline"></ion-icon> Proposer une offre d'emploi
                </a>
            @elseif(auth()->user()->role_id === 4) <!-- Ecole -->
                <a class="btn btn-primary btn-block" href="{{ route('formation.create') }}">
                    <ion-icon class="align-top h4 mb-0" name="add-outline"></ion-icon> Proposer une formation
                </a>
                @endif--}}
        </div>

        <!-- Parties utilisateurs -->
        <div id="users-list" class="row mb-4">
            @foreach($users->items() as $user)
                <x-user-card :user="$user"></x-user-card>
            @endforeach
        </div>

        <x-load-more-button></x-load-more-button>

    </x-container>
@endsection

@section('script')
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
@endsection
