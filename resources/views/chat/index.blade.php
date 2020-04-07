@extends('layouts.base', ['full_width' => true, 'title' => 'Conversations'])

@section('content')
    <div class="flex flex-row">
        <!-- Liste des personnes -->
        <div class="people-chat w-full lg:w-11/12 lg:mx-auto flex flex-col border-solid h-screen overflow-y-auto">
            <div class="w-11/12 mx-auto lg:w-full">
                <h1 class="text-xl text-gray-700 mb-3">Espace conversations</h1>
            </div>
            <!-- Liste des gens à qui ont a envoyés un chat -->
            @if(count($inbox) > 0)
                @foreach($inbox as $conversations)
                    @php
                    $participants = \Musonza\Chat\Models\Conversation::find($conversations)->getParticipants();
                    @endphp
                    @foreach($participants as $id => $participant)
                        @if($participant->id === auth()->id())
                            @php
                            unset($participant->id);
                            @endphp
                        @else
                        <a class="flex hover:bg-blue-100 bg-white border-b border-gray-200 border-solid" href="{{ route('chat.chat', $conversations) }}">
                            <div class="flex flex-row px-2 pt-4 pb-5 relative w-full">

                                <div class="w-2/12 lg:w-1/12 self-center">
                                    <img src="{{ \App\User::getAvatar($participant->id) }}" class="mx-auto h-10 rounded-full" alt="">
                                </div>
                                <div class="w-8/12 ml-1">
                                    <div class="author text-gray-700 font-bold">{{ \App\User::find($participant->id)->username }}</div>
                                    <div class="author truncate text-gray-500 truncate">{{--$inbox->thread->chat--}}</div>
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
                        @endif
                    @endforeach
                @endforeach
            @elseif(count($conversations) <= 0)
                <div>Aucune conversation</div>
            @endif
        </div>
    </div>
@endsection
