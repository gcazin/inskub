@forelse($formations as $formation)
    <div class="d-flex bg-white shadow-sm rounded mb-3 px-1 py-3">
        <div class="col-lg-1 d-flex text-center align-self-center">
            <img class="rounded-circle" style="height: 50px" src="{{ \App\User::getAvatar($formation->user_id) }}" alt="">
        </div>
        <div class="col-lg-11">
            <p class="h4">
                <a href="{{ route('formation.show', $formation->id) }}">{{ $formation->title }}</a>
            </p>
            <p>{{ $formation->description }}</p>
            <div class="row">
                <div class="col text-muted">
                    Publiée par {{ \App\User::find($formation->user_id)->last_name }} {{ \Carbon\Carbon::create($formation->created_at)->diffForHumans() }}
                </div>
                <div class="col text-right">
                    <a class="btn btn-outline-primary" href="{{ route('formation.show', $formation->id) }}">Postuler</a>
                </div>
            </div>
        </div>
        <div class="col-lg-5"></div>
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
