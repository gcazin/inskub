@extends('layouts.base', ['full_width' => true])

@section('content')
    <!-- Chat  -->
    <div id="conversation" class="flex flex-col w-full lg:w-8/12 bg-white">
        <div class="w-11/12 mx-auto">
            <div class="border-b border-solid border-gray-200 text-gray-600 items-center flex" style="height: 50px">
                Conversation avec @foreach($participants as $key => $value) {{ \App\User::find($value)->value('name') }} @endforeach
            </div>
            <div class="py-2 relative overflow-y-auto" style="height: 400px" id="talkMessages">
                @foreach($messages as $message)
                    <div class="flex @if($message['is_sender'] === auth()->user()->id) justify-end @endif" id="message-{{$message['id']}}">
                        <div class="bull py-3 w-8/12">
                            <div class="flex @if($message['is_sender'] === auth()->user()->id) justify-end @endif">
                                <div class="w-11/12 bg-gray-200 rounded-lg px-5 py-2">
                                    <p>{{$message['body']}}</p>
                                    <div class="text-right">
                                        <small class="text-sm text-gray-600">{{--$message->humans_time--}}</small>
                                        <a href="#" class="talkDeleteMessage" data-message-id="{{$message['id']}}" title="Delete Message"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Champ de saisie pour écrire un chat -->
            <div class="flex items-center">
                <form action="{{ route('ajax::chat.new') }}" method="post" id="talkSendMessage" class="w-full relative">
                    @csrf
                    <input type="hidden" name="_id" value="{{@request()->route('id')}}">
                    <input name="message-data" id="message-data" class="input" placeholder="Écrivez votre message" style="height: 70px">
                    <button type="submit" class="absolute mr-4 mt-3 text-blue-500 text-xl" style="top: 39%;right: 1%;transform: translate(-50%, -50%)">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let top_menu = document.querySelector('header').clientHeight
        let bottom_menu = document.getElementById('mobile-menu').clientHeight
        let conversation = document.getElementById('conversation')

        conversation.clientHeight = conversation.clientHeight + top_menu + bottom_menu
    </script>
@endsection
