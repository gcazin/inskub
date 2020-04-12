@extends('layouts.base', ['full_width' => true])

@section('content')
    <div class="profile -mt-5 mb-3">
        <div class="profile__banner overflow-hidden h-24">
            <img src="https://images.unsplash.com/photo-1531256379416-9f000e90aacc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80" class="w-full" alt="">
        </div>
        <div class="flex justify-center -mt-8 bg-white">
            <img src="{{ \App\User::getAvatar(auth()->id()) }}" class="h-16 rounded-full border-solid border-white border-2 -mt-3">
        </div>
        <div class="profile__infos shadow-sm bg-white py-1">
            <div class="w-11/12 mx-auto">
                <div class="flex justify-between">
                    <p class="text-xl font-light">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</p>
                    @if(auth()->id() === (int) request()->route('id'))
                        <a class="text-gray-700" href="{{ route('user.edit') }}"><ion-icon class="align-bottom text-lg" name="settings-outline"></ion-icon></a>
                    @else
                        <a class="text-xl" href="{{ route('chat.createConversation', $user->id) }}">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </a>
                    @endif

                </div>
                <p class="text-sm text-gray-700 mb-3">
                    {{ \App\User::getNumberFollowers(auth()->id()) }} abonnés -
                    {{ \App\User::getNumberFollowings(auth()->id()) }} abonnements
                </p>
            </div>
        </div>
    </div>
    <!-- Post -->
    <div class="w-11/12 mx-auto">
        <div class="card shadow bg-white shadow rounded">
            <div class="card__header flex items-center justify-between px-3 py-2">
                <div class="card__header--title">
                    <h2 class="text-gray-800">Ajouter des formations</h2>
                </div>
                <div class="card__header--button">
                    <a class="btn btn-blue btn-sm" href="{{ route('user.formation.create') }}">
                        <ion-icon class="text-xl" name="add-circle-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="card__body"></div>
        </div>
    </div>
@endsection
