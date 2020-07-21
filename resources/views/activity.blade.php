@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')
    <x-container>
        <p class="h3 mb-3 text-muted">Tableau de bord</p>
        <hr>
        <h3 class="mb-4"><ion-icon class="align-text-top text-primary" name="newspaper-outline"></ion-icon> Publications</h3>
        <div class="row text-center mb-4">
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $posts->count() }}</p>
                    <span class="text-muted h4">publications postées</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ auth()->user()->likes()->count() }}</p>
                    <span class="text-muted h4">mentions j'aimes</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ \App\Reply_post::where('user_id', auth()->id())->count() }}</p>
                    <span class="text-muted h4">commentaires postés</span>
                </x-section>
            </div>
        </div>

        <h3 class="mb-3"><ion-icon class="align-text-top text-primary" name="list-outline"></ion-icon> Projets</h3>
        <div class="row text-center mb-3">
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->count() }}</p>
                    <span class="text-muted h4">projets postés</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->where('finish', 0)->count() }}</p>
                    <span class="text-muted h4">projets en cours</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->where('finish', 1)->count() }}</p>
                    <span class="text-muted h4">projets terminés</span>
                </x-section>
            </div>
        </div>

    </x-container>
    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
