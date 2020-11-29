<div class="row">
    @forelse($jobs as $job)
        <x-section class="w-100 position-relative" style="cursor: pointer">
            <div class="row mb-3">
                <div class="col-1 img-container">
                    <img class="rounded-lg" title="{{ $job->user->last_name }}" style="height: 50px" src="{{ $job->user::getAvatar($job->user_id) }}" alt="">
                </div>
                <div class="col">
                    <span>{{ $job->title }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col h5">
                </div>
                <div class="col text-muted text-right">
                    {{ $job->created_at->diffForHumans() }}
                </div>
            </div>
            <a id="{{ $job->id }}" class="job-item position-absolute w-100 h-100" style="left: 0; bottom: 0; top: 0; right: 0;"></a>
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
        {{ $jobs->links() }}
    </div>
</div>
