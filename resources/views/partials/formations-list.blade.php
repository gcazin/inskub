<div class="row">
    @forelse($formations as $formation)
        <x-section class="w-100 position-relative" style="cursor: pointer">
            <div class="row mb-3">
                <div class="col-1 img-container">
                    <img class="rounded-lg" title="{{ $formation->user->last_name }}" style="height: 50px" src="{{ $formation->user::getAvatar($formation->user_id) }}" alt="">
                </div>
                <div class="col">
                    <span>{{ $formation->title }}</span>
                    <p class="text-muted">{{ $formation->location }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col h5">
                    @if($formation->level)
                        <span class="badge badge-primary">{{ $formation->level }}</span>
                    @endif
                </div>
                <div class="col text-muted text-right">
                    {{ $formation->created_at->diffForHumans() }}
                </div>
            </div>
            <a id="{{ $formation->id }}" class="formation-item position-absolute w-100 h-100" style="left: 0; bottom: 0; top: 0; right: 0;"></a>
        </x-section>
    @empty
        <x-element.alert type="info">
            <x-slot name="title">
                Aucun résultat à afficher.
            </x-slot>
        </x-element.alert>
    @endforelse
</div>
<div class="flex items-center py-3">
    <div class="flex-1">
        {{ $formations->links() }}
    </div>
</div>
