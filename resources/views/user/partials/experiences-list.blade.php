@forelse(\App\UserExperience::all()->where('user_id', @request()->route('id'))->sortByDesc('finish_date') as $experience)
    <div class="job-post border rounded p-3 mb-3">
        <div class="row">
            <div class="col">
                <p class="h4 font-bold">
                    {{ $experience->title }}
                </p>
                <p class="text-xl text-gray-800">{{ $experience->enterprise }}</p>
                <p class="text-sm">{{ $experience->start_date }} - {{ $experience->finish_date }}</p>
            </div>
            <div class="col h5 text-right">
                <span class="badge badge-primary">
                    {{ $experience->enterprise }}
                </span>
            </div>
        </div>
    </div>
@empty
    <div class="pt-2 pb-1">
        <div class="alert alert-info">
            Aucune expérience à afficher.
        </div>
    </div>
@endforelse
