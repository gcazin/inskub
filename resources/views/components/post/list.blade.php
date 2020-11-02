<div id="post-list">
    @forelse($model as $post)
        @if(request()->is('project*'))
            <x-post.item :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-post.item>
        @else
            <x-post.item :post="$post"></x-post.item>
        @endif
    @empty
        <div class="mt-3">
            <x-element.alert type="info">
                <x-slot name="title">
                    Aucune publication à afficher pour l'instant.
                </x-slot>
            </x-element.alert>
        </div>
    @endforelse
</div>
