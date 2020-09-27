@extends('layouts.base', ['full_width' => false])

@section('title')
    Résultat de la recherche des experts
@endsection

@section('content')
    <x-container>
        <h2 class="text-black-50 mb-4">Liste des experts</h2>
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
                        <p class="text-muted font-italic">Cet expert n'a pas encore d'avis</p>
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
