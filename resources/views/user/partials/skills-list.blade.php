@forelse($skills as $skill)
    <div class="job-post border rounded p-3 mb-3">
        <div class="row">
            <div class="col">
                <p class="font-bold ">
                {{ ucfirst($skill->title) }}{{ $loop->last ? '' : ','}}
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
