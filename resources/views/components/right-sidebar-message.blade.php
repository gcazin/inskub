<div class="col-2 offset-1 position-sticky d-none d-lg-flex flex-column rounded-lg mt-3 pr-3">
    <x-section>

        <h6 class="title__section text-uppercase text-secondary mb-3">Messagerie</h6>

        @forelse(auth()->user()->followings as $person)
            <div class="row menu-item">
                <div class="col-2 px-0">
                    <img class="rounded-circle" style="height: 2rem" src="{{ $person->getAvatar($person->id) }}" alt="">
                </div>
                <div class="col-8">
                    <span class="mr-auto font-weight-bold">{{ $person->first_name }} {{ $person->last_name }}</span>
                </div>
                <div class="col-1">
                    <span class="d-inline-block bg-success rounded-circle" style="height: 5px; width: 5px"></span>
                </div>
                <a class="position-absolute h-100 w-100" href="{{ route('chat.createConversation', $person->id) }}"></a>
            </div>
        @empty
            <x-alert type="info">
                Rien à afficher ici pour le moment
            </x-alert>
        @endforelse

    </x-section>
</div>
