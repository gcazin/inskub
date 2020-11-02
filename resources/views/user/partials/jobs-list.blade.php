@forelse(\App\Models\Job::all()->where('user_id', request()->route('id'))->sortByDesc('created_by') as $job)
    <div class="job-post p-3 border rounded mb-3">
        <div class="row">
            <div class="col">
                <p class="h4 font-bold">
                    <a class="text-decoration-none" href="{{ route('job.show', $job->id) }}">
                        {{ $job->title }}
                    </a>
                </p>
            </div>
            <div class="col h5 text-right">
                <span class="badge badge-primary">
                    {{ \App\Models\Job_type::find($job->type_id)->title }}
                </span>
            </div>
        </div>
    </div>
@empty
    <x-element.alert type="info">
        <x-slot name="title">
            Vous n'avez encore ajouté aucune offre d'emploi
        </x-slot>
    </x-element.alert>
@endforelse
