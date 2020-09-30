@extends('layouts.base', ['full_width' => false])

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Résultat de la recherche des experts
@endsection

@section('content')
    <x-container>
        <x-header title="Liste des experts"></x-header>
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
    </x-container>
    <x-right-sidebar-message></x-right-sidebar-message>
@endsection

@section('script')
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
@endsection
