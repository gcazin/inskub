@extends('layouts.base')

@section('content')

    <div class="col-lg-10 mt-3 px-3 px-lg-0">
        <div class="container-fluid">
            <div class="row mx-2 shadow-sm">

                <div class="col-lg-3 overflow-auto bg-white py-3 border-right rounded-left automatic-height {{ request()->id ? 'd-none d-lg-block' : null }}">
                    <div class="form-group">
                        <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#create-conversation">Commencer une conversation</button>
                    </div>

                    <x-modal title="Commencer une conversation"  name="create-conversation">
                        @forelse(auth()->user()->followings as $following)
                            @if(\Musonza\Chat\Facades\ChatFacade::conversations()->between(auth()->user(), $following) === null)
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
                            @else
                                @if($loop->last)
                                    <x-alert type="info">
                                        Plus aucune conversation ne peut être démarré
                                    </x-alert>
                                @endif
                            @endif
                        @empty
                            <x-alert type="info">
                                Aucune relation à afficher.
                            </x-alert>
                        @endforelse
                    </x-modal>

                    @forelse($conversations as $conversation)
                        @foreach($conversation->conversation->getParticipants()->reverse()->take(1) as $participant)
                            <div class="menu-item border-bottom px-2 {{ (int) request()->id === (int) $conversation->id ? 'active' : null }} position-relative">
                                <div class="row overflow-auto align-items-center">
                                    <div class="col-2 col-lg-2 text-center">
                                        <img class="rounded-circle" src="{{ \App\User::find($participant->id)->avatar }}" style="height: 40px" alt="">
                                    </div>
                                    <div class="col-10 align-self-center col-lg-8">
                                        <p class="font-weight-bold h6">{{ \App\User::find($participant->id)->first_name }} {{ \App\User::find($participant->id)->last_name }}</p>
                                        @if(!empty($conversation->conversation->last_message->body))
                                            <p>{{ $conversation->conversation->last_message->body }}</p>
                                        @else
                                            <p class="text-muted">Commencer a chatter!</p>
                                        @endif
                                    </div>
                                    <a class="position-absolute w-100 h-100" href="{{ route('chat.index', $conversation->id) }}"></a>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <x-alert type="info">Aucune conversation à afficher</x-alert>
                    @endforelse
                </div>

                <!-- Chat -->
                <div class="col-lg-6 bg-white rounded-right automatic-height {{ request()->id ? 'd-block' : 'd-none d-lg-block' }}">
                    <!-- Chat -->
                    @yield('chat')
                </div>

                @if(request()->route('id'))
                    <div class="col-lg-3 py-3 bg-white d-none d-lg-block border-left rounded-right">
                        <!-- Chat -->
                        <span class="text-muted">Options de la conversation</span>
                    </div>
                @endif

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        let body = window.document.body;
        body.className = 'vh-100'
        let automatic = document.querySelectorAll('.automatic-height')
        let mobileMenu = document.getElementById('mobile-menu').clientHeight

        let navbar = document.querySelector('.navbar').clientHeight;

        let height = () => {
            for(i = 0; i < automatic.length; i++) {
                automatic[i].style.height = body.clientHeight - (mobileMenu + 50) - 100 - navbar + 'px';
            }
            console.log(automatic)
        }
        height()

        window.addEventListener('resize', () => {
            height()
        })
    </script>
@endsection
