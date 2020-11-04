<span style="cursor: pointer" wire:click="addLike({{ $post->id }})">
    <ion-icon class="align-top h5 mb-0 {{ $post->isLikedBy(auth()->user()) ? 'text-danger' : 'text-muted' }} mb-0" name="heart"></ion-icon>
    {{ $post->likers()->count() }}
</span>
