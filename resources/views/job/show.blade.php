<x-section class="position-relative">
    <div class="mb-3">
        <img width="100" class="rounded-lg shadow-sm" src="{{ $job->user::getAvatar($job->user_id) }}" alt="">
    </div>
    <div class="row mb-4">
        <div class="col">
            <p class="h3">{{ $job->title }}</p>
        </div>
    </div>
    <div class="row no-gutters mb-3">
        <div class="col">
            <a class="mr-1" href="{{ route('user.profile', $job->user->id) }}">{{ $job->user->last_name }} </a> | <span class="ml-1"> {{ $job->location }}</span>
        </div>
        <div class="col text-right">
            <span class="text-muted">{{ $job->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="row no-gutters mb-3">
        <div class="col border px-3 py-2">
            <p class="text-muted">Salaire</p>
            <span>{{ $job->salary ?? 'Non spécifié' }}</span>
        </div>
    </div>

    <div>
        <p class="h5 text-black-50">Description de l'offre d'emploi</p>
        <p>{{ $job->description }}</p>
    </div>

    <div class="row py-3">
        <div class="col-lg-4">
            <span class="text-muted">Prendre contact</span>
        </div>
        <div class="col-lg-6">
            <a target="_blank" class="btn btn-primary" href="mailto:{{ $job->user->email }}">Postuler</a>
        </div>
    </div>
</x-section>

