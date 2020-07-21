@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')
    <x-container>
        <h2 class="text-muted">Liste des experts</h2>
        @forelse($experts as $expert)
            <div class="card mb-3">
                <div class="card-header bg-white border-0">
                    <a class="h4" href="{{ route('formation.show', $expert->id) }}">
                        {{ $expert->last_name .' '. $expert->first_name}}
                    </a>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        {{ $expert->about }}
                    </p>
                </div>
            </div>
        @empty
            <x-alert type="info">
                Aucun résultat à afficher.
            </x-alert>
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
