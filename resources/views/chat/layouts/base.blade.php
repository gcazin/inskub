@extends('layouts.base')

@section('content')

    <div class="col-lg-10 mt-3 px-3 px-lg-0">

        <div class="container-fluid">

            <div class="row mx-2 shadow-sm">

                <div class="col-lg-3 overflow-auto bg-white py-3 border-right rounded-left automatic-height">
                    @forelse($conversations as $conversation)
                        @foreach($conversation->conversation->getParticipants()->reverse()->take(1) as $participant)
                            <div class="menu-item px-2 {{ (int) request()->id === (int) $conversation->id ? 'active' : null }} position-relative">
                                <div class="row overflow-auto align-items-center">
                                    <div class="col-lg-2 d-none d-lg-block text-center">
                                        <img class="rounded-circle" src="{{ \App\User::find($participant->id)->avatar }}" style="height: 40px" alt="">
                                    </div>
                                    <div class="col-4 col-lg-8">
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
                <div class="col-lg-6 py-3 bg-white rounded-right">
                    <!-- Chat -->
                    @yield('chat')
                </div>

                @if(request()->route('id'))
                    <div class="col-lg-3 py-3 bg-white border-left rounded-right">
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
        let automatic = document.querySelector('.automatic-height')

        let navbar = document.querySelector('.navbar').clientHeight;

        let height = () => {
            automatic.style.height = body.clientHeight - 100 - navbar + 'px';
        }
        height()
        window.addEventListener('resize', () => {
            height()
        })
    </script>
@endsection
