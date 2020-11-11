<x-section>
    <!-- Commentaires -->
    <p class="text-sm">Commentaires</p>
    @if(count($post->replies) > 0)
        @foreach($post->replies as $reply)
            <div class="container-fluid">
                <div class="row">
                    <div class="col-1">
                        <a href="{{ route('user.profile', $reply->user_id) }}">
                            <img class="rounded-circle" height="35" width="35"
                                 src="{{ \App\Models\User::find($reply->user_id)->getAvatar($reply->user_id) }}" alt="">
                        </a>
                    </div>
                    <div class="col-11 bg-light rounded-lg px-3 py-2">
                        <a href="{{ route('user.profile', $reply->user_id) }}"
                           class="text-primary" class="text-sm font-bold">
                            {{ $post->user->first_name }} {{ $post->user->last_name }}
                        </a>
                        <p class="mb-0">{{ $reply->message }}</p>
                    </div>
                </div>
                @endforeach
                @else
                    <x-element.alert type="info">
                        <x-slot name="title">
                            Aucun élément à afficher, soyez la première personne à publier un commentaire.
                        </x-slot>
                    </x-element.alert>
                @endif
            </div>
</x-section>
