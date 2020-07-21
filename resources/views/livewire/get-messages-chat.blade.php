<div wire:poll>
    <div class="overflow-y-auto" id="conversation">
        <div class="px-3 py-4 shadow-sm"><span class="text-muted">Conversation avec </span></div>
        @forelse(collect()$messages as $message)
            <div
                id="message-{{$message['id']}}"
                class="d-flex flex-column mb-2 p-3 {{ $message['is_sender'] === 1 ? 'justify-content-end' : null }}">

                <div class="d-flex w-100 flex-row @if($message['is_sender'] === 1) justify-content-end @endif">
                    <!-- Destinataire -->
                    @if(!$direct && $message['is_sender'] === 0)
                        <img class="h-10 rounded-full mr-2" src="{{ \App\User::getAvatar($message['sender']['id']) }}" alt="">
                    @endif
                    <div class="w-50 @if($message['is_sender'] === 1) {{'bg-primary text-white'}} @else {{'bg-light'}} @endif rounded-lg px-2 py-2">
                        <p class="@if($message['is_sender'] === 1) {{'text-white'}} @else {{''}} @endif">{{$message['body']}}</p>
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
            <p class="text-muted">Commencer à chatter dès maintenant</p>
        @endforelse
    </div>
</div>
