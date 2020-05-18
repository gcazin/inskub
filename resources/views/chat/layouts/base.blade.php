@extends('layouts.base', ['full' => true])

@section('content')
    <div class="row no-gutters automatic-height border-top border-light" style="margin-top: -1rem;">
        <!-- Conversations -->
        <div class="col-2 col-lg-4 border-right border-light">
            @foreach($conversations as $conversation)
                @foreach($conversation->participants as $participant)
                    @php $user = $user::find($participant['messageable_id']); @endphp
                    @if($user->id !== auth()->id())
                        <div class="card {{ $loop->first ? 'rounded-top-lg' : 'rounded-0' }} border-0 py-2 py-lg-0">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <img class="rounded-circle" src="{{ $user->avatar }}" style="height: 50px" alt="">
                                    </div>
                                    <div class="d-none d-lg-block col-lg-8">
                                        <p class="font-weight-bold h6">{{ $user->first_name }} {{ $user->last_name }}</p>
                                        <p>message</p>
                                    </div>
                                    <div class="d-none d-lg-block col-lg-2">salut</div>
                                </div>
                            </div>
                            <a class="position-absolute w-100 h-100" href="{{ route('chat.index', $conversation->id) }}"></a>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>

        <!-- Chat -->
        <div class="col-10 col-lg-8 px-3 border-right border-light bg-white" style="height: 85%">
            @yield('chat')
        </div>

        <!-- Informations -->
        <!--<div class="col-lg-4 d-none d-lg-block  px-3 bg-white automatic-height">
            salut
        </div>-->
    </div>

@endsection

@section('script')
    <script>
        let body = window.document.body;
        body.className = 'vh-100'
        let automatic = document.querySelector('.automatic-height')

        let navbar = document.querySelector('.navbar').clientHeight;

        let height = () => {
            automatic.style.height = body.clientHeight - navbar + 'px';
        }
        height()
        window.addEventListener('resize', () => {
            height()
        })
    </script>
@endsection
