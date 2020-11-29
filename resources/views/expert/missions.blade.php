<x-page title="Vos missions">
    <x-header>
        <x-slot name="title">Vos missions</x-slot>
    </x-header>

    <x-container>
        @forelse($requests->sortByDesc('created_at') as $request)
            <x-section>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            <p class="h4">Demande envoyé par <span class="text-primary">{{ $request->sender->first_name .' ' . $request->sender->last_name }}</span></p>
                        </div>
                        @if($request->status === $request::CURRENT_STATUS || $request->status === $request::MORE_INFO_STATUS)
                            <div class="col text-right">
                                <a class="btn btn-primary" href="{{ route('expert.accept', $request->id) }}">Accepter</a>
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".refuse-expertise">
                                    Refuser
                                </button>
                                @if($request->status !== $requestExpertise::MORE_INFO_STATUS && $request->status !== $request::REFUSE_STATUS && $request->detailed_description === null)
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target=".more-info-expertise">
                                        Demande d'informations supplémentaire
                                    </button>
                                @endif

                                <div class="text-left">

                                    <!-- Modal de demande d'infos supp. -->
                                    <x-element.modal title="Demande d'informations supplémentaire" name="more-info-expertise">
                                        <x-form.item :action="route('expert.moreInfo', $request->id)">
                                            <x-form.textarea name="further_information" label="Informations complémentaires" rows="3" placeholder="Veuillez marquer ici les informations qu'ils vous manquent pour au mieux traiter cette demande."></x-form.textarea>
                                            <hr>
                                            <x-form.submit>Envoyer la demande</x-form.submit>
                                        </x-form.item>
                                    </x-element.modal>

                                    <!-- Modal de refus -->
                                    <x-element.modal title="Refus d'une mission d'expertise" name="refuse-expertise">
                                        <x-form.item :action="route('expert.refuse', $request->id)">
                                            <x-form.textarea name="refuse_reason" label="Raison" rows="3" placeholder="Veuillez marquer ici explicitement la raison pour laquelle vous ne pouvez traiter cette demande d'expertise."></x-form.textarea>
                                            <hr>
                                            <x-form.submit>Envoyer le refus</x-form.submit>
                                        </x-form.item>
                                    </x-element.modal>

                                </div>
                            </div>
                        @elseif($request->status === $requestExpertise::ACCEPT_STATUS)
                            <span class="badge badge-success">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Vous avez accepté cette demande
                                    </span>
                        @elseif($request->status === $requestExpertise::MORE_INFO_STATUS)
                            <span class="badge badge-dark">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        En attente d'informations
                                    </span>
                        @else
                            <span class="badge badge-danger">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Vous avez refusé cette demande.
                                    </span>
                        @endif
                    </div>

                    @if($request->status !== $requestExpertise::REFUSE_STATUS)
                        <div class="mt-3">
                            Brève description : <p class="font-weight-bold">{{ $request->description }}</p>
                        </div>

                        @if($request->further_information !== null)
                            <div class="mt-3">
                                Votre demande : <p class="font-weight-bold">{{ $request->further_information }}</p>
                            </div>
                        @endif

                        @if($request->detailed_description !== null)
                            <div class="mt-3">
                                La réponse : <p class="font-weight-bold">{{ $request->detailed_description }}</p>
                            </div>
                        @endif
                    @endif

                    @if($request->status === $requestExpertise::ACCEPT_STATUS)
                        <div class="mt-3 text-right">
                            <a href="{{ route('project.show', $request->project_id) }}">Projet</a>
                            <span class="text-muted">|</span>
                            <a href="{{ route('chat.show', $request->conversation_id .'?type=1' )}}">Conversation</a>
                        </div>
                    @endif

                </div>
            </x-section>
        @empty
            <x-element.alert type="info">
                <x-slot name="title">
                    Aucune mission en cours.
                </x-slot>
            </x-element.alert>
        @endforelse
    </x-container>
</x-page>
