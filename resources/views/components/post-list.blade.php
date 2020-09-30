<!-- Post -->
<div class="w-100">
    @if(request()->is('project/*'))
        <div class="d-flex">
            <div class="col align-self-center">
                <span class="text-muted" id="count"></span>
            </div>
            <div class="col text-right">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrer par
                    </button>
                    <div class="dropdown-menu filters" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('all')">Voir tout</a>
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('images')">Images</a>
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('documents')">Documents</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @forelse($model as $post)
        @if(request()->is('project/*'))
            <x-post :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-post>
        @else
            <x-post :post="$post"></x-post>
        @endif
    @empty
        <div class="mt-3">
            <x-alert type="info" icon="information-circle-outline">
                Personne n'a encore publier dans votre espace projet
            </x-alert>
        </div>
    @endforelse
</div>
