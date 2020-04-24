@extends('layouts.base', ['full_width' => true])

@section('content')
    <div class="profile -mt-5 mb-3">
        <div class="profile__banner overflow-hidden h-24">
            <img src="{{ asset('storage/users/profile_background.png') }}" class="w-full" alt="">
        </div>
        <div class="flex justify-center -mt-8 bg-white">
            <img alt="avatar" src="{{ \App\User::getAvatar($user->id) }}"
                 class="h-16 rounded-full border-solid border-white border-2 -mt-3">
        </div>
        <div class="profile__infos shadow-sm bg-white py-1">
            <div class="w-11/12 mx-auto">
                <div class="flex justify-between">
                    <p class="text-xl font-light">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</p>
                    @if(auth()->id() === (int) request()->route('id'))
                        <a class="text-gray-700" href="{{ route('user.edit') }}">
                            <ion-icon class="align-bottom text-xl" name="settings-outline"></ion-icon>
                        </a>
                    @else
                        <a class="text-xl" href="{{ route('chat.createConversation', $user->id) }}">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </a>
                    @endif

                </div>
                <p class="text-sm text-gray-700 mb-3">
                    <a href="{{ route('user.follower', $user->id) }}">
                        {{ \App\User::getNumberFollowers(auth()->id()) }} abonnés
                    </a> -
                    <a href="{{ route('user.following', $user->id) }}">
                    {{ \App\User::getNumberFollowings(auth()->id()) }} abonnements
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Etudiants et salariés -->
    @if($user->role_id === 2 || $user->role_id === 5)
        <!-- Formations -->
        <div class="w-11/12 mx-auto mb-3">
            <div class="card">
                <div class="card__header">
                    <div class="card__header--title">
                        <h2>Formations</h2>
                    </div>
                    @if((int) request()->route('id') === (int) auth()->id())
                        <div class="card__header--button">
                            <a href="{{ route('user.formation.create') }}">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card__body">
                    @include('user.partials.formations-list')
                </div>
            </div>
        </div>

        <!-- Expériences -->
        <div class="w-11/12 mx-auto">
            <div class="card">
                <div class="card__header flex items-center justify-between px-3 pt-2">
                    <div class="card__header--title">
                        <h2 class="text-xl text-gray-800">Expériences</h2>
                    </div>
                    @if((int) request()->route('id') === (int) auth()->id())
                        <div class="card__header--button">
                            <a href="{{ route('user.experience.create') }}">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card__body">
                    @include('user.partials.experiences-list')
                </div>
            </div>
        </div>
    @endif

    <!-- Entreprise -->
    @if($user->role_id === 3)
        <!-- Formations -->
        <div class="w-11/12 mx-auto mb-3">
            <div class="card">
                <div class="card__header">
                    <div class="card__header--title">
                        <h2>Emplois proposés</h2>
                    </div>
                    @if(request()->route('id') === (int) auth()->id())
                        <div class="card__header--button">
                            <a href="{{ route('user.formation.create') }}">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card__body">
                    @include('user.partials.jobs-list')
                </div>
            </div>
        </div>
    @endif

    <!-- Ecole -->
    @if($user->role_id === 4)
        <!-- Formations -->
        <div class="w-11/12 mx-auto mb-3">
            <div class="card">
                <div class="card__header">
                    <div class="card__header--title">
                        <h2>Formations</h2>
                    </div>
                    @if(request()->route('id') === (int) auth()->id())
                        <div class="card__header--button">
                            <a href="{{ route('user.formation.create') }}">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card__body">
                    @include('user.partials.formations-list')
                </div>
            </div>
        </div>
    @endif
@endsection
