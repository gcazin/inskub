@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')

    <x-container>
        <h2 class="text-black-50 mb-4">Découvrir</h2>
        <!-- Offres d'emploi, proposer une formation etc. -->
        <div class="card">
            <div class="card-body">
            @if(auth()->user()->role_id === 1) <!-- Admin -->
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
                @endif
            </div>
        </div>

        <!-- Parties utilisateurs -->
        @foreach($roles as $role)
            <div class="my-3">
                <div class="row">
                    <div class="col">
                        <h1 class="text-xl">{{ $role->display_name }}</h1>
                    </div>
                </div>
                <div class="d-flex overflow-auto pb-4">
                    @foreach($role->users->take(10) as $member)
                        <div class="col-lg-3 col-6 card border shadow-sm text-center mr-2">
                            <div class="flex justify-center py-4">
                                <a href="{{ route('user.profile', $member->id) }}">
                                    <img style="height: 80px" class="rounded-circle border border-light" src="{{ $member->getAvatar($member->id) }}" alt="">
                                </a>
                            </div>
                            <a href="{{ route('user.profile', $member->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $member->first_name }} {{ $member->last_name }}</a>
                            <p class="pb-4 text-gray-600">
                                {{ $member->followers()->count() }} abonnés
                            </p>
                            @if($member->id !== auth()->id())
                                <p class="pb-4">
                                    <livewire:follow-user :member="$member->id">
                                </p>
                            @endif
                        </div>
                    @endforeach
                    <div class="col-lg-3 col-6 d-flex justify-content-center align-items-center">
                        <a href="{{ route('discover.all', $role->id) }}" class="btn btn-outline-primary">Voir tout</a>
                    </div>
                </div>
            </div>
        @endforeach

    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
