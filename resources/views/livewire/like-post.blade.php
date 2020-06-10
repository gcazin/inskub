<button class="btn btn-light {{ $post->isLikedBy(auth()->user()) ? 'text-primary' : null }}" wire:click="addLike({{ $post->id }})">
    <ion-icon class="align-text-bottom" name="thumbs-up-outline"></ion-icon>
    J'aime
</button>
