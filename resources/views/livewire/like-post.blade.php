<button class="btn btn-light btn-sm py-2 rounded-circle" wire:click="addLike({{ $post->id }})">
    <ion-icon class="align-middle {{ $post->isLikedBy(auth()->user()) ? 'text-danger' : 'text-muted' }} mb-0" name="heart"></ion-icon>
    {{ $post->likers()->count() }}
</button>
