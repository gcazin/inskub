<div wire:poll>
    <div class="overflow-y-auto" id="conversation">
        <div class="w-50 m-auto pt-3">
            <x-alert type="warning">Les messages envoyés dans cette discussion sont chiffrés de bout en bout. Appuyez pour plus d'informations.</x-alert>
        </div>
        @forelse($messages as $message)
            <div
                id="message-{{$message['id']}}"
                class="d-flex flex-column mb-2 p-3 {{ $message['is_sender'] === 1 ? 'justify-content-end' : null }}">

                <div class="d-flex w-100 flex-row @if($message['is_sender'] === 1) justify-content-end @endif">
                    <!-- Destinataire -->
                    <div class="w-50 @if($message['is_sender'] === 1) {{'bg-primary text-white'}} @else {{'bg-light'}} @endif rounded-lg px-2 py-2">
                        <p class="@if($message['is_sender'] === 1) {{'text-white'}} @else {{''}} @endif">{{ decrypt($message['body']) }}</p>
                    <!--<div class="text-right">
                                <a href="#" data-message-id="{{$message['id']}}" title="Delete Message"><i class="fa fa-close"></i></a>
                            </div>-->

                    </div>
                </div>
                <small class="text-muted {{ $message['is_sender'] === 1 ? 'text-right' : null }}">
                    {{ \Carbon\Carbon::make($message['created_at'])->diffForHumans() }}
                </small>
            </div>
        @empty
            <p class="text-muted p-3">Commencer à chatter dès maintenant</p>
        @endforelse
    </div>
</div>
