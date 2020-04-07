@extends('layouts.base', ['full_width' => true])

@section('content')
    <!-- Chat  -->
    <div class="flex flex-col -mt-5 w-full lg:w-8/12 bg-white">
        <div class="w-11/12 mx-auto flex flex-col" style="height: 81vh">
            <div class="border-b border-solid border-gray-200 text-gray-600 items-center flex" style="height: 50px">
                Conversation avec @foreach($participants as $key => $value) {{ ($key === auth()->id()) ? \App\User::find($value)->username : null }} @endforeach
            </div>
            <div class="flex-1 py-2 relative overflow-y-auto" id="conversation">
                <livewire:get-messages-chat :conversationId="@request()->route('id')">
            </div>

            <!-- Champ de saisie pour écrire un chat -->
            <div class="flex items-center">
                <livewire:create-message-chat :conversation="@request()->route('id')">
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
    <script>
        document.addEventListener('livewire:available', function () {
            window.livewire.on('postAdded', function () {
                console.log('salut')
            });
        });
    </script>
    <script>
        var messageBody = document.querySelector('#conversation');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    </script>
@endsection
