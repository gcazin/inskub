@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')

    <x-container>

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
                <div class="group__title rounded">
                    <h1 class="text-xl">{{ $role->display_name }}</h1>
                </div>
                <div class="d-flex overflow-auto pb-4">
                    @foreach($role->users as $member)
                        <div class="col-lg-2 col-6 card border shadow-sm text-center mr-2">
                            <div class="flex justify-center py-4">
                                <img style="height: 80px" class="rounded-circle border border-light" src="{{ $member->getAvatar($member->id) }}" alt="">
                            </div>
                            <a href="{{ route('user.profile', $member->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $member->first_name }} {{ $member->last_name }}</a>
                            <p class="pb-4 text-gray-600">
                                {{ count($member->followers()->get()) }} abonnés
                            </p>
                            <p class="pb-4">
                                <livewire:follow-user :member="$member->id">
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
