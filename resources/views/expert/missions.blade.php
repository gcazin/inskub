<x-page>
    <x-header>
        <x-slot name="title">Vos missions</x-slot>
    </x-header>

    <x-container>
        <x-section>
            @forelse($requests as $request)
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            <p class="h4">Demande envoyé par <span class="text-primary">{{ $request->sender->first_name .' ' . $request->sender->last_name }}</span></p>
                        </div>
                        @if($request->status === \App\Models\RequestExpertise::CURRENT_STATUS)
                            <div class="col text-right">
                                <a class="btn btn-primary" href="{{ route('expert.accept', $request->id) }}">Accepter</a>
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".refuse-expertise">
                                    Refuser
                                </button>

                                <div class="text-left">
                                    <x-element.modal title="Refus d'une mission d'expertise" name="refuse-expertise">
                                        <x-form.item :action="route('expert.refuse', $request->id)">

                                            <!-- Raison de l'abandon -->
                                            <x-form.textarea name="refuse_reason" label="Raison" rows="3" placeholder="Veuillez marquer ici explicitement la raison pour laquelle vous ne pouvez traiter cette demande d'expertise."></x-form.textarea>

                                            <hr>
                                            <x-form.submit>Envoyer le refus</x-form.submit>
                                        </x-form.item>
                                    </x-element.modal>
                                </div>
                            </div>
                        @elseif($request->status === \App\Models\RequestExpertise::ACCEPT_STATUS)
                            <span class="badge badge-success">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Vous avez accepté cette demande
                                    </span>
                        @else
                            <span class="badge badge-danger">
                                        <ion-icon name="checkmark-outline" class="h5 mb-0 align-text-bottom"></ion-icon>
                                        Vous avez refusé cette demande
                                    </span>
                        @endif
                    </div>

                    @if($request->status !== \App\Models\RequestExpertise::REFUSE_STATUS)
                        <div class="mt-3">
                            Brève description: <p class="font-weight-bold">{{ json_decode($request->description)[0] }}</p>
                            <hr>
                            Description détaillée: <p class="font-weight-bold">{{ json_decode($request->description)[1] }}</p>
                        </div>
                    @endif

                    @if($request->status === \App\Models\RequestExpertise::ACCEPT_STATUS)
                        <div class="mt-3 text-right">
                            <a href="{{ route('project.show', $request->project_id) }}">Projet</a>
                            <span class="text-muted">|</span>
                            <a href="{{ route('chat.show', $request->conversation_id .'?type=1' )}}">Conversation</a>
                        </div>
                    @endif

                </div>
            @empty
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune mission en cours.
                    </x-slot>
                </x-element.alert>
            @endforelse
        </x-section>
    </x-container>
</x-page>
