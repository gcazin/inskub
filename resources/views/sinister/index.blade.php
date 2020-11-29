<x-page title="Suivre un sinistre">
    <x-header>
        <x-slot name="title">Suivre un sinistre</x-slot>
        <x-slot name="subtitle">Vous pouvez ici suivre toutes vos demandes en cours de sinistres.</x-slot>
    </x-header>

    <x-container>
        @forelse($sinisters->sortByDesc('created_at') as $sinister)
            <x-section>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            <p class="h4">Demande envoyé à <span class="text-primary">{{ $sinister->expert->first_name .' ' . $sinister->expert->last_name }}</span></p>
                        </div>
                        <div class="col text-right">
                            <h5>
                                @if($sinister->status === $sinister::CURRENT_STATUS)
                                    <div class="badge badge-info">
                                        <div class="spinner-border text-info spinner-border-sm mr-1" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        En cours de traitement
                                    </div>
                                @elseif($sinister->status === $sinister::ACCEPT_STATUS)
                                    <span class="badge badge-success">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Accepté
                                    </span>
                                @elseif($sinister->status === $sinister::MORE_INFO_STATUS)
                                    <span class="badge badge-ifno">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        L'expert vous demande des informations
                                    </span>

                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target=".more-info-expertise">
                                        Demande d'informations supplémentaire
                                    </button>
                                    <div class="text-left">
                                        <x-element.modal title="Demande d'informations supplémentaire" name="more-info-expertise">
                                            <x-section class="d-block mb-3">
                                                <small>{{ $sinister->further_information }}</small>
                                            </x-section>

                                            <x-form.item :action="route('expert.detailedDescriptionExpertise', $sinister->id)">
                                                <x-form.textarea name="detailed_description" label="Informations complémentaires" rows="3" placeholder="Veuillez indiquer les informations que l'expert vous a demandé pour traiter au mieux votre demande."></x-form.textarea>
                                                <hr>
                                                <x-form.submit>Envoyer la demande</x-form.submit>
                                            </x-form.item>
                                        </x-element.modal>
                                    </div>
                                @else
                                    <span class="badge badge-danger">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        L'expert à refusé votre demande
                                    </span>
                                @endif
                            </h5>
                        </div>
                    </div>

                    @if($sinister->status === $sinister::REFUSE_STATUS)
                        <div class="mt-3">
                            <p>
                                Raison du refus: {{ $sinister->refuse_reason }}
                            </p>
                        </div>
                    @endif

                    @if($sinister->status !== $sinister::REFUSE_STATUS)
                        <div class="mt-3">
                            Brève description : <p class="font-weight-bold">{{ $sinister->description }}</p>
                        </div>

                        @if($sinister->further_information !== null)
                            <div class="mt-3">
                                La demande : <p class="font-weight-bold">{{ $sinister->further_information }}</p>
                            </div>
                        @endif

                        @if($sinister->detailed_description !== null)
                            <div class="mt-3">
                                Votre réponse : <p class="font-weight-bold">{{ $sinister->detailed_description }}</p>
                            </div>
                        @endif
                    @endif

                    @if($sinister->status === $sinister::ACCEPT_STATUS)
                        <div class="mt-3 text-right">
                            <a href="{{ route('project.show', $sinister->project_id) }}">Projet</a>
                            <span class="text-muted">|</span>
                            <a href="{{ route('chat.show', $sinister->conversation_id .'?type=1' )}}">Conversation</a>
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
