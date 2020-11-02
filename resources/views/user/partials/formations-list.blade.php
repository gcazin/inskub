@forelse(\App\Models\UserFormation::all()->where('user_id', request()->route('id'))->sortByDesc('finish_date') as $formation)
    <div class="job-post border rounded p-3 mb-3">
        <div class="row">
            <div class="col">
                <p class="h4 font-bold">
                    {{ $formation->school }}
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
    <x-element.alert type="info">
        <x-slot name="title">
            Aucune formation à afficher.
        </x-slot>
    </x-element.alert>
@endforelse
