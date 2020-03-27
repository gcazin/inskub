@extends('layouts.base', ['full_width' => true, 'title' => 'Conversations'])

@section('content')
    <div class="flex flex-row">

        <!-- Liste des personnes -->
        <div class="people-chat w-full lg:w-4/12 flex flex-col border-solid h-screen overflow-y-auto">
            <!-- Liste des gens à qui ont a envoyés un chat -->
            @if(count($conversations) > 0)
                @foreach($conversations as $conversation)
                    <a class="flex hover:bg-blue-100 bg-white border-b border-gray-200 border-solid" href="{{ route('chat.chat', 2) }}">
                        <div class="flex flex-row px-2 pt-4 pb-5 relative w-full">
                            <div class="w-full lg:w-2/12 self-center">
                                <img src="{{-- \App\User::getAvatar($inbox->withUser->id) --}}" class="mx-auto h-16 rounded-full" alt="">
                            </div>
                            <div class="w-8/12 ml-2 hidden lg:block">
                                <div class="author text-gray-700 font-bold">{{--$inbox->withUser->name--}}</div>
                                <div class="author truncate text-gray-500 trcunate">{{--$inbox->thread->chat--}}</div>
                            </div>
                            <div class="w-2/12 text-sm text-gray-500 text-right hidden lg:block">
                                <div class="date">{{-- $inbox->thread->humans_time --}}</div>

                                {{--@if(auth()->user()->id == $inbox->thread->sender->id)
                                    <div class="reply"><i class="fas fa-reply"></i></div>
                                @else
                                    @if($inbox->thread->is_seen === 0)
                                        <div class="w-2 h-2 bg-green-500 rounded-full ml-auto mt-3"></div>
                                    @endif
                                @endif--}}
                            </div>

                        </div>
                    </a>
                @endforeach
            @elseif(count($conversation) < 0)
                <div>Aucune conversation</div>
            @endif
        </div>
    </div>
@endsection
