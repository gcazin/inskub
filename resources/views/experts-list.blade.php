@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')
    <x-container>
        <h2 class="text-muted">Liste des experts</h2>
        @forelse($experts as $expert)
            <div class="d-flex px-3 py-4 bg-white shadow-sm mb-3 rounded">
                <div class="col-2"><img src="{{ \App\User::getAvatar($expert->id) }}" style="height: 80px" class="rounded-circle" alt=""></div>
                <div class="col-5">
                    <p><a href="{{ route('user.profile', $expert->id) }}" class="text-primary font-weight-bold h5">{{ $expert->first_name .' '. $expert->last_name }}</a></p>
                    <p class="text-muted">{{ $expert->description ?? 'Aucune description renseignée' }}</p>
                    <a href="{{ route('user.profile', $expert->id) }}" class="btn btn-outline-primary">Voir le profil</a>
                </div>
                <div class="d-flex flex-column col-5 border-left border-primary" style="border-left-width: 2px !important;">
                    <div>
                        <p class="text-primary">Compétences</p>
                        <p>
                        @forelse($expert->skills as $skill)
                            {{ $skill->title }}{{ $loop->last ? '' : ','}}
                        @empty
                            <p class="text-muted font-italic">Aucune compétence renseignée</p>
                            @endforelse
                            </p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('chat.createConversation', $expert->id) }}" class="btn btn-primary">Contacter {{ $expert->first_name }}</a>
                    </div>
                </div>
            </div>
        @empty
            <x-alert type="info">Aucun résultat à afficher.</x-alert>
        @endforelse
        <div class="flex items-center py-3">
            <div class="flex-1">
                <span class="text-gray-700 text-sm">Page {{ $experts->currentPage() }}</span>
            </div>
            <div class="flex-1">
                {{ $experts->links() }}
            </div>
        </div>
    </x-container>
    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
