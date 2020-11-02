<x-page>
    <x-header>
        <x-slot name="title">Chat</x-slot>
    </x-header>

    <x-container>
        <x-section>

            <div class="row">
                <div class="col-lg-3 overflow-auto bg-white py-3 border-right rounded-left automatic-height {{ request()->id ? 'd-none d-lg-block' : null }}">
                    <div class="form-group">
                        <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#create-conversation">Commencer une conversation</button>
                    </div>

                    <x-element.modal title="Commencer une conversation"  name="create-conversation">
                        <div class="container-fluid">
                            @forelse(auth()->user()->followings as $following)
                                @if(\Musonza\Chat\Facades\ChatFacade::conversations()->between(auth()->user(), $following) === null)
                                    <div class="row align-items-center {{ ! $loop->last ? 'pb-3' : null }}">

                                        <div class="col-1 px-2">
                                            <img class="rounded-circle" style="height: 50px" src="{{ \App\Models\User::find($following->id)::getAvatar($following->id) }}" alt="">
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('user.profile', $following->id) }}" class="h4">{{ $following->first_name }} {{ $following->last_name }}</a>
                                            <p class="text-muted mb-0">
                                                {{ \App\Models\User::find($following->id)->followers()->count() }} abonnés
                                            </p>
                                        </div>
                                        <div class="col-1 text-center">
                                            <a href="{{ route('chat.createConversation', $following->id) }}">
                                                <ion-icon class="h3 text-primary" name="send-outline"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    @if($loop->last)
                                        <x-element.alert type="info">
                                            <x-slot name="title">
                                                Plus aucune conversation ne peut être démarré
                                            </x-slot>
                                        </x-element.alert>
                                    @endif
                                @endif
                            @empty
                                <x-element.alert type="info">
                                    <x-slot name="title">
                                        Vous ne suivez aucune personne pour l'instant
                                    </x-slot>
                                    <x-slot name="description">
                                        Rendez-vous dans l'espace <a href="{{ route('discover.index') }}">découvrir</a> pour commencer à chatter!
                                    </x-slot>
                                </x-element.alert>
                            @endforelse
                        </div>
                    </x-element.modal>

                    <div class="btn-group btn-block mb-3" role="group" aria-label="Basic example">
                        <a href="{{ route('chat.show', ['type' => '0']) }}" class="btn btn-btn btn-{{ request()->type === null || (int) request()->type === 0 ? 'primary' : 'outline-primary' }} btn-sm" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">Personnel</a>
                        <a href="{{ route('chat.show', ['type' => '1']) }}" class="btn btn-{{ request()->type !== null && (int) request()->type === 1 ? 'primary' : 'outline-primary' }} btn-sm" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">Expertise</a>
                    </div>
                    @forelse($conversations->where('type_id', '=', request()->type) as $conversation)
                        @foreach($conversation->conversation->getParticipants()->where('id', '<>', auth()->id()) as $participant)
                            <div class="menu-item border-bottom px-2 position-relative">
                                <div class="position-relative">
                                    <div class="mb-3">
                                        <img class="img-fluid mr-2 rounded-circle" src="{{ \App\Models\User::find($participant->id)->avatar }}" style="height: 40px" alt="">
                                        <span class="font-weight-bold h6">{{ $conversation->type_id === 0 ? \App\Models\User::find($participant->id)->first_name
.' '.\App\Models\User::find($participant->id)->last_name : json_decode($conversation->data)->title }}</span>
                                    </div>
                                    <div class="">
                                        @if(!empty($conversation->conversation->last_message->body))
                                            <p>{{ decrypt($conversation->conversation->last_message->body) }} @if($conversation->conversation->last_message->is_sender === 0 && $conversation->conversation->last_message->is_seen === 0) <span class="float-right bg-primary rounded-circle" style="height: 10px; width: 10px"></span> @endif</p>

                                        @else
                                            <span class="text-muted">Commencer a chatter!</span>
                                        @endif
                                    </div>
                                    <a class="position-absolute w-100 h-100" style="top: 0" href="{{ route('chat.show', ['id' => $conversation->id, 'type' => request()->type ?: 0]) }}"></a>
                                </div>

                            </div>
                        @endforeach
                    @empty
                        <x-element.alert type="info">
                            <x-slot name="title">
                                Aucune conversation à afficher.
                            </x-slot>
                        </x-element.alert>
                    @endforelse
                </div>

                <!-- Chat -->
                <div class="col-lg bg-white rounded-right automatic-height {{ request()->id ? 'd-block' : 'd-none d-lg-block' }}">
                    <!-- Chat -->
                    @yield('chat')
                </div>

                @if(request()->route('id'))
                    <div class="col-lg-3 py-3 bg-white d-none d-lg-block border-left rounded-right">
                        <!-- Chat -->
                        <span class="text-muted d-block mb-2">Options de la conversation</span>
                        <div class="form-group">
                            <x-form.item :action="route('chat.destroy', $conversations[0]->id)" method="DELETE">
                                <button type="submit" class="btn btn-outline-danger">Supprimer la conversation</button>
                            </x-form.item>
                        </div>
                    </div>
                @endif
            </div>

        </x-section>
    </x-container>

    <x-slot name="script">
        <script>
            let body = window.document.body;
            body.className = 'vh-100'
            let automatic = document.querySelectorAll('.automatic-height')
            let mobileMenu = document.getElementById('mobile-menu').clientHeight

            let navbar = document.querySelector('.navbar').clientHeight;

            let height = () => {
                for(let i = 0; i < automatic.length; i++) {
                    automatic[i].style.height = body.clientHeight - (mobileMenu + 50) - 100 - navbar + 'px';
                }
                console.log(automatic)
            }
            height()

            window.addEventListener('resize', () => {
                height()
            })
        </script>
    </x-slot>
</x-page>
