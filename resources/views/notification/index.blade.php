<x-page>

    <x-header>
        <x-slot name="title">Notifications</x-slot>
    </x-header>

    <x-container>
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
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune notification à afficher.
                    </x-slot>
                </x-element.alert>
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
                        @if(\App\Models\RequestExpertise::where('sender_id', '=', $notification->data['sender_id'])->where('expert_id', '=', auth()->id())->get('accepted') === 0)
                            <a href="{{ route('expert.acceptExpertise', $notification->id) }}" class="btn btn-primary">Accepter</a>
                            <a href="" class="btn btn-outline-danger">Refuser</a>
                        @else
                            <span class="badge badge-success">Expertise acceptée</span>
                        @endif
                    </div>
                </div>
            @empty
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune notification à afficher.
                    </x-slot>
                </x-element.alert>
            @endforelse
        </div>
    </x-container>
</x-page>
