<x-page>
    <x-header>
        <x-slot name="title">Suivre un sinistre</x-slot>
        <x-slot name="subtitle">Vous pouvez ici suivre toutes vos demandes en cours de sinistres.</x-slot>
    </x-header>

    <x-container>
        @forelse($sinisters as $sinister)
            <x-section>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            <p class="h4">Demande envoyé à <span class="text-primary">{{ $sinister->expert->first_name .' ' . $sinister->expert->last_name }}</span></p>
                        </div>
                        <div class="col text-right">
                            <h5>
                                @if($sinister->status === \App\Models\RequestExpertise::CURRENT_STATUS)
                                    <div class="badge badge-info">
                                        <div class="spinner-border text-info spinner-border-sm mr-1" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        En cours de traitement
                                    </div>
                                @elseif($sinister->status === \App\Models\RequestExpertise::ACCEPT_STATUS)
                                    <span class="badge badge-success">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Accepté
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        L'expert à refusé votre demande
                                    </span>
                                @endif
                            </h5>
                            @if($sinister->status === \App\Models\RequestExpertise::ACCEPT_STATUS)
                                <div class="mt-3">
                                    <a href="{{ route('project.show', $sinister->project_id) }}">Projet</a>
                                    <span class="text-muted">|</span>
                                    <a href="{{ route('chat.show', $sinister->conversation_id .'?type=1' )}}">Conversation</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($sinister->status === \App\Models\RequestExpertise::REFUSE_STATUS)
                        <div class="mt-3">
                            <p>
                                Raison du refus: {{ $sinister->refuse_reason }}
                            </p>
                        </div>
                    @endif

                </div>
            </x-section>
        @empty
            <x-element.alert type="info">
                <x-slot name="title">Aucune demande en cours.</x-slot>
            </x-element.alert>
        @endforelse
    </x-container>
</x-page>
