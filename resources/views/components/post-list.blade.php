<!-- Post -->
<div class="w-100">
    @forelse($model as $post)
        @if(request()->is('project/*'))
            <x-post :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-post>
        @else
            <x-post :post="$post"></x-post>
        @endif
    @empty
        <x-alert type="info" icon="information-circle-outline">
            Personne n'a encore publier dans votre espace projet
        </x-alert>
    @endforelse
</div>
