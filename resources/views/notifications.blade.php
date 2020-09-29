@extends('layouts.base', ['full_width' => false])

@section('title')
    Notifications
@endsection

@section('content')
    <x-container>
        <h2 class="text-black-50 mb-4">Notifications</h2>
        <div class="form-group">
            <div class="row mb-2">
                <div class="col">
                    <h4>Nouveau</h4>
                </div>
                <div class="col text-right">
                    <a href="{{ route('notification.markAllAsRead') }}" class="btn btn-outline-primary">Tout marquer comme lue</a>
                </div>
            </div>
            @forelse(auth()->user()->unreadNotifications as $notification)
                <div class="d-flex px-1 py-3 bg-white shadow-sm rounded">
                    <div class="col-8">
                        <ion-icon class="h2 mb-0 align-middle p-2 bg-primary rounded-circle mr-3 text-white" name="{{ $notification->type === \App\Notifications\RequestingExpertise::class ? 'hand-left-outline' : '' }}"></ion-icon>
                        {{ $notification->data['message'] }}
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('expert.acceptExpertise', $notification->id) }}" class="btn btn-primary">Accepter</a>
                        <a href="" class="btn btn-outline-danger">Refuser</a>
                    </div>
                </div>
            @empty
                <x-alert type="info">Aucune notification à afficher.</x-alert>
            @endforelse
        </div>
        <div class="form-group">
            <h4>Plus tôt</h4>
            @forelse(auth()->user()->notifications->where('read_at', '<>', null) as $notification)
                <div class="d-flex px-1 py-3 bg-white shadow-sm rounded">
                    <div class="col-8">
                        <ion-icon class="h2 mb-0 align-middle p-2 bg-primary rounded-circle mr-3 text-white" name="hand-left-outline"></ion-icon>
                        {{ $notification->data['message'] }}
                    </div>
                    <div class="col-4 text-right">
                        @if(\App\RequestExpertise::where('sender_id', '=', $notification->data['sender_id'])->where('expert_id', '=', auth()->id())->get('accepted') === 0)
                            <a href="{{ route('expert.acceptExpertise', $notification->id) }}" class="btn btn-primary">Accepter</a>
                            <a href="" class="btn btn-outline-danger">Refuser</a>
                        @else
                            <span class="badge badge-success">Expertise acceptée</span>
                        @endif
                    </div>
                </div>
            @empty
                <x-alert type="info">Aucune notification à afficher.</x-alert>
            @endforelse
        </div>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div class="toast" id="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#toast').toast('show')
    </script>
@endsection
