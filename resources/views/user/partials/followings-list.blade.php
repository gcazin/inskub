@extends('layouts.base')

@section('content')

    <div class="w-11/12 lg:w-7/12 mx-auto">
        <h1 class="text-2xl text-gray-700 mb-2">{{ count($user->followings) }} résultat{{ count($user->followings) < 0 ? 's' : '' }}</h1>
        @forelse($user->followings as $following)
            <div class="card">
                <div class="flex items-center justify-center">
                    <div class="w-2/12">
                        <img class="h-10 rounded-full" src="{{ \App\User::find($following->id)::getAvatar($following->id) }}" alt="">
                    </div>
                    <div class="w-8/12 mx-2">
                        <a href="{{ route('user.profile', $following->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $following->first_name }} {{ $following->last_name }}</a>
                        <p class="pb-4 text-gray-600">
                            {{ count(\App\User::find($following->id)->followers()->get()) }} abonnés
                        </p>
                    </div>
                    <div class="w-2/12 self-center text-right">
                        <p class="pb-4">
                            <a href="{{ route('chat.createConversation', $following->id) }}">
                                <ion-icon class="text-xl text-blue-500" name="send-outline"></ion-icon>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="pt-2 pb-1">
                <div class="alert alert-info">
                    Aucune relation à afficher.
                </div>
            </div>
        @endforelse
    </div>


@endsection
