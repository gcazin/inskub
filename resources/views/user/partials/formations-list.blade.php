@forelse(\App\UserFormation::all()->where('user_id', request()->route('id'))->sortByDesc('finish_date') as $formation)
    <div class="job-post border rounded p-3">
        <div class="row">
            <div class="col">
                <p class="h4 font-bold">
                    <a class="text-decoration-none" href="{{ route('formation.show', $formation->id) }}">
                        {{ $formation->school }}
                    </a>
                </p>
                <p class="text-muted">{{ $formation->start_date }} - {{ $formation->finish_date }}</p>
            </div>
            <div class="col h5 text-right">
                <span class="badge badge-primary">
                    {{ $formation->degree }}
                </span>
            </div>
        </div>
    </div>
@empty
    <x-alert type="info">
        Aucune formation à afficher.
    </x-alert>
@endforelse
