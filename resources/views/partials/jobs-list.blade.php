<div class="list-group list-group-flush">
    @forelse($jobs as $job)
        <a href="{{ route('job.show', $job->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $job->title }}</h5>
                <small>{{ \Carbon\Carbon::make($job->created_at)->diffForHumans() }}</small>
            </div>
            <p class="my-3">{{ $job->description }}</p>
            <small>
                Publiée par
                <img class="rounded-circle" style="height: 30px" src="{{ \App\User::getAvatar($job->user_id) }}" alt=""> {{ \App\User::find($job->user_id)->last_name }}
            </small>
        </a>
    @empty
        <div class="px-3 pt-2 pb-1">
            <div class="alert alert-info">
                Vous n'avez encore ajouté aucune formations
            </div>
        </div>
    @endforelse
</div>
<div class="mt-3">
    {{ $jobs->links() }}
</div>
