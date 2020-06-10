@extends('layouts.base')

@section('content')

    <x-container>
        <h1 class="text-2xl text-gray-700 mb-2">{{ $user->followers->count() }} résultat{{ $user->followers->count() > 0 ? 's' : '' }}</h1>
        @forelse($user->followers as $follower)
            <x-section class="mb-3">
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img class="rounded-circle" style="height: 50px" src="{{ \App\User::find($follower->id)::getAvatar($follower->id) }}" alt="">
                    </div>
                    <div class="col-8">
                        <a href="{{ route('user.profile', $follower->id) }}" class="h4">{{ $follower->first_name }} {{ $follower->last_name }}</a>
                        <p class="text-muted">
                            {{ \App\User::find($follower->id)->followers()->count() }} abonnés
                        </p>
                    </div>
                    <div class="col-2 text-center">
                        <a href="{{ route('chat.createConversation', $follower->id) }}">
                            <ion-icon class="h3 text-primary" name="send-outline"></ion-icon>
                        </a>
                    </div>
                </div>
            </x-section>
        @empty
            <x-alert type="info">
                Aucune relation à afficher.
            </x-alert>
        @endforelse
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>


@endsection
