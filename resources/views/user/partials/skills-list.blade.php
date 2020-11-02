@forelse(\App\Models\UserSkillPivot::all()->where('user_id', request()->route('id')) as $experience)
    <div class="job-post border rounded p-3 mb-3">
        <div class="row">
            <div class="col">
                <p class="font-bold ">
                @forelse($experience->skills as $skill)
                    {{ ucfirst($skill->title) }}{{ $loop->last ? '' : ','}}
                @empty
                    <p class="text-muted font-italic">Aucune compétence renseignée</p>
                    @endforelse
                    </p>
            </div>
        </div>
    </div>
@empty
    <x-element.alert type="info">
        <x-slot name="title">
            Aucune compétence à afficher.
        </x-slot>
    </x-element.alert>
@endforelse
