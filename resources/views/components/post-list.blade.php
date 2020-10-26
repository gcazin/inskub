<div id="post-list">
    @forelse($model as $post)
        @if(request()->is('project*'))
            <x-post :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-post>
        @else
            <x-post :post="$post"></x-post>
        @endif
    @empty
        <div class="mt-3">
            <x-alert type="info">
                <x-slot name="title">
                    Personne n'a encore publier dans votre espace projet
                </x-slot>
            </x-alert>
        </div>
    @endforelse
</div>
