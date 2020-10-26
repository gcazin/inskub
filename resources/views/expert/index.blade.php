@extends('layouts.base', ['full_width' => false])

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('title')
    Recherche d'un expert
@endsection

@section('content')
    <x-header>
        <x-slot name="title">Rechercher un expert</x-slot>
        <x-slot name="subtitle">Trouver l'expert qui correspond à votre besoin en toute simplicité</x-slot>
        <x-slot name="content">
            <div class="form-group">
                <label>Domaine de compétence</label>
                <select class="skills form-control" id="skills" name="skills[]" multiple>
                    @foreach(\App\UserSkill::all() as $skill)
                        <option value="{{ $skill->id }}">{{ ucfirst($skill->title) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="departments">Localisation</label>
                <select class="departments form-control" id="departments" name="departments[]" multiple>
                    @foreach(\App\Department::all()->sortBy('code') as $department)
                        <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="companies" id="companies">
                    <label class="custom-control-label" for="switch1">Compagnie agrée</label>
                </div>
            </div>
            <x-submit id="btn-search">Rechercher</x-submit>
        </x-slot>
    </x-header>

    <x-container>
        <div class="row" id="experts-list">
            @foreach($experts as $expert)
                <x-user-card :user="$expert"></x-user-card>
            @endforeach
        </div>
    </x-container>

    <x-load-more-button></x-load-more-button>


    @isset($result)
        @forelse($result as $expert)
            <div class="d-flex px-3 py-4 bg-white shadow-sm mb-3 rounded">
                <div class="col-2"><img src="{{ \App\User::getAvatar($expert->id) }}" style="height: 80px" class="rounded-circle" alt=""></div>
                <div class="col-5">
                    <p><a href="{{ route('user.profile', $expert->id) }}" class="text-primary font-weight-bold h5">{{ $expert->first_name .' '. $expert->last_name }}</a></p>
                    <p class="text-muted {{ $expert->about ?: 'font-italic' }}">{{ $expert->about ?: 'Aucune description renseignée' }}</p>
                    <a href="{{ route('user.profile', $expert->id) }}" class="btn btn-outline-primary">Voir le profil</a>
                </div>
                <div class="d-flex flex-column col-5 border-left border-primary" style="border-left-width: 2px !important;">
                    <div>
                        <p class="text-primary">Avis</p>
                        @if($expert->ratings->count() >= 3)
                            <p><input id="rating" name="input-3" value="{{ $expert->ratings->avg('rating') }}" class="kv-ltr-theme-svg-star rating-loading" data-size="sm"></p>
                        @else
                            <p class="text-muted font-italic">Cet expert n'a pas encore assez d'avis</p>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <x-form :action="route('expert.request', $expert->id)">
                            <x-submit>Demande d'expertise</x-submit>
                        </x-form>
                    </div>
                </div>
            </div>
        @empty
            <x-alert type="info">Aucun résultat à afficher.</x-alert>
        @endforelse
    @endisset
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/fr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.js"></script>
    <script>
        $(document).ready(function(){
            $('.kv-ltr-theme-svg-star').rating({
                displayOnly: true,
                step: 0.5,
                hoverOnClear: false,
                theme: 'krajee-svg',
                language: 'fr'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.skills').select2();
            $('.departments').select2();
        });
    </script>

    <script type="module">
        import { loadMoreData } from "{{ asset('js/ajax.js') }}"

        loadMoreData('/experts', 'experts-list')
    </script>

    <script type="text/javascript">
        let input = $('#skills')
        let btnSearch = $('#btn-search')

        $(input).change(function (e) {
            e.preventDefault();

            let formData = {
                skills: $('#skills').val(),
                departments: $('#departments').val(),
                companies: $('#companies').val(),
            };
            let type = "POST";
            let ajaxurl = "{{ config('app.url') }}/experts/search";

            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success : function(data) {
                    if (data.html.length === 0) {
                        $('#experts-list').html(data.html);
                        $('#load-more').text("Aucun résultat").attr('disabled', true)
                    } else {
                        if(data.initial) {
                            $('#load-more').html("Voir plus").attr('disabled', false)
                            $('#experts-list').html(data.html);
                        } else {
                            console.log(data.html.length)
                            let plural = data.html.length <= 1 ? '' : 's'

                            $('#load-more').text(data.html.length + " résultat" + plural).attr('disabled', true)
                            $('#experts-list').html(data.html);
                        }
                    }
                },
                error: function (data) {
                    console.log('My object: ', data);
                }
            });
        });
    </script>
@endsection
