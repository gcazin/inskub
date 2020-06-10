@forelse($jobs as $job)
    <div class="card mb-3">
        <div class="card-header bg-white border-0">
            <a class="h4" href="{{ route('job.show', $job->id) }}">
                {{ $job->title }}
            </a>
        </div>
        <div class="card-body">
             <p>{{ $job->description }}</p>
            <p class="">
                Publiée par
                <img class="rounded-circle" style="height: 40px" src="{{ \App\User::getAvatar($job->user_id) }}" alt="">
                {{ \App\User::find($job->user_id)->last_name }}
            </p>
        </div>
    </div>
@empty
    <div class="px-3 pt-2 pb-1">
        <div class="alert alert-info">
            Vous n'avez encore ajouté aucune formations
        </div>
    </div>
@endforelse
{{ $jobs->links() }}
