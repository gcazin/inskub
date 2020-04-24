@forelse(\App\Job::all()->where('user_id', request()->route('id'))->sortByDesc('created_by') as $job)
    <div class="formation flex py-4 border-b border-gray-400">
        <div class="w-11/12 lg:w-full">
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">
                    <a class="text-xl font-bold text-blue-600" href="{{ route('job.show', $job->id) }}">
                        {{ $job->title }}
                    </a>
                </h1>
                <p>
                        <span class="bg-green-100 text-green-600 text-sm px-2 py-1 rounded-lg">
                            {{ \App\Job_type::find($job->type_id)->title }}
                        </span>
                </p>
            </div>
            <div class="flex">
                <p class="w-1/2 text-sm text-gray-600 truncate">
                    Publiée par
                    <img class="inline h-5 rounded-full" src="{{ \App\User::getAvatar($job->user_id) }}" alt="">
                    {{ \App\User::find($job->user_id)->last_name }}
                </p>
            </div>
        </div>
    </div>
@empty
    <div class="px-3 pt-2 pb-1">
        <div class="alert alert-info">
            Vous n'avez encore ajouté aucune offre d'emploi
        </div>
    </div>
@endforelse
