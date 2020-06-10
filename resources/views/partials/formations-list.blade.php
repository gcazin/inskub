@forelse($formations as $formation)
    <div class="card mb-3">
        <div class="card-header bg-white border-0">
            <a class="h4" href="{{ route('formation.show', $formation->id) }}">
                {{ $formation->title }}
            </a>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Publiée par
                <img class="rounded-circle" style="height: 40px" src="{{ \App\User::getAvatar($formation->user_id) }}" alt="">
                {{ \App\User::find($formation->user_id)->last_name }}
            </p>
        </div>
    </div>
@empty
    <x-alert type="info">
        Aucun résultat à afficher.
    </x-alert>
@endforelse
<div class="flex items-center py-3">
    <div class="flex-1">
        <span class="text-gray-700 text-sm">Page {{ $formations->currentPage() }}</span>
    </div>
    <div class="flex-1">
        {{ $formations->links() }}
    </div>
</div>
