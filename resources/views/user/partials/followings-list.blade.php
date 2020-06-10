@extends('layouts.base')

@section('content')

    <x-container>
        <h1 class="text-2xl text-gray-700 mb-2">{{ $user->followings->count() }} résultat{{ $user->followings->count() > 0 ? 's' : '' }}</h1>
        @forelse($user->followings as $following)
            <x-section class="mb-3">
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img class="rounded-circle" style="height: 50px" src="{{ \App\User::find($following->id)::getAvatar($following->id) }}" alt="">
                    </div>
                    <div class="col-8">
                        <a href="{{ route('user.profile', $following->id) }}" class="h4">{{ $following->first_name }} {{ $following->last_name }}</a>
                        <p class="text-muted">
                            {{ \App\User::find($following->id)->followers()->count() }} abonnés
                        </p>
                    </div>
                    <div class="col-2 text-center">
                        <a href="{{ route('chat.createConversation', $following->id) }}">
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
