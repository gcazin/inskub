@extends('layouts.base', ['full_width' => true])

@section('content')
    <!-- Chat  -->
    <div class="flex flex-col -mt-5 w-full lg:w-full bg-white">
        <div class="w-11/12 mx-auto flex flex-col" style="height: 77vh">
            <div class="flex justify-between items-center border-b border-solid border-gray-200 text-gray-600" style="height: 50px">
                <div>
                    Conversation avec
                    @foreach($participants as $participant)
                        {{ \App\User::find($participant['messageable_id'])->username }}{{ ($loop->last) ? '.' : ',' }}
                    @endforeach
                </div>
                <div>
                    <button class="modal-open" class="text-lg"><ion-icon class="align-middle" name="settings-outline"></ion-icon></button>
                    @component('partials.modal')
                        @slot('title')
                            Réglages
                        @endslot
                        <form action="{{ route('chat.addParticipants', request()->route('id')) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="participants">Ajouter des participants</label>
                                <input type="hidden" name="conversation_id" value="{{ request()->route('id') }}">
                                <select id="participants" name="participants[]" class="input" multiple>
                                    @foreach(\App\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @slot('footer')
                                <button class="modal-close btn btn-light">Fermer</button>
                                <button type="submit" class="btn btn-blue ml-1">Sauvegarder</button>
                        </form>

                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="flex-1 py-2 relative overflow-y-auto" id="conversation">
                <livewire:get-messages-chat :conversation="@request()->route('id')">
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

        var messageBody = document.querySelector('#conversation');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

        window.livewire.on('messageAdded', () => {
            window.livewire.hook('afterDomUpdate', () => {
                var messageBody = document.querySelector('#conversation');
                messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
            });
        })
    </script>
@endsection
