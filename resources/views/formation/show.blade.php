<x-section class="position-relative">
    <div class="mb-3">
            <img width="100" class="rounded-lg shadow-sm" src="{{ $formation->user::getAvatar($formation->user_id) }}" alt="">
    </div>
    <div class="row mb-4">
        <div class="col">
            <p class="h3">{{ $formation->title }}</p>
        </div>
    </div>
    <div class="row no-gutters mb-3">
        <div class="col">
            <a class="mr-1" href="{{ route('user.profile', $formation->user->id) }}">{{ $formation->user->last_name }} </a> | <span class="ml-1"> {{ $formation->location }}</span>
        </div>
        <div class="col text-right">
            <span class="text-muted">{{ $formation->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="row no-gutters mb-3">
        <div class="col border px-3 py-2">
            <p class="text-muted">Niveau d'étude</p>
            <span>{{ $formation->level ?? 'Non spécifié' }}</span>
        </div>
        <div class="col border px-3 py-2">
            <p class="text-muted">Prix d'entrée</p>
            <span>{{ $formation->entry_price ?? 'Non spécifié'}}</span>
        </div>
    </div>

    <div>
        <p class="h5 text-black-50">Description de la formation</p>
        <p>{{ $formation->description }}</p>
    </div>

    <div class="row py-3">
        <div class="col-lg-4">
            <span class="text-muted">Prendre contact</span>
        </div>
        <div class="col-lg-6">
            <a target="_blank" class="btn btn-primary" href="mailto:{{ \App\Models\User::find($formation->user_id)->email }}">Postuler</a>
        </div>
    </div>
</x-section>
