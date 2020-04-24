<!-- Post -->
@foreach($posts->sortByDesc('created_at') as $post)
    @if($post->user_id === auth()->id() || auth()->user()->isFollowing($post->user_id))
        @if($post->visibility_id !== 3 || $post->user_id === auth()->id())
            <div class="post-card">
                <div class="post-card__content">
                    <div class="flex items-center justify-center mt-1">
                        <div class="mr-3">
                            <a href="{{ route('user.profile', $post->user_id) }}">
                                <img class="rounded-full" height="40" width="40" src="{{ \App\User::getAvatar($post->user_id) }}" alt="avatar">
                            </a>
                        </div>
                        <div class="flex-1 my-1">
                            <a href="{{ route('user.profile', $post->user_id) }}" class="hover:underline text-blue-800">
                                {{ App\User::find($post->user_id)->first_name }} {{ App\User::find($post->user_id)->last_name }}
                            </a>
                            <div class="text-xs text-gray-600 flex items-center">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <span class="ml-1 text-sm">
                                @switch($post->visibility_id)
                                    @case(1) <!-- Public -->
                                        <ion-icon name="globe-outline"></ion-icon>
                                    @break
                                    @case(2) <!-- Followers -->
                                        <ion-icon name="people-outline"></ion-icon>
                                    @break
                                    @case(3) <!-- Privée -->
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        @break
                                    @endswitch
                            </span>
                            </div>
                        </div>
                    </div>
                    <article class="pt-3 pb-5 text-grey-darkest">
                        {{ $post->content }}
                        @if($post->media !== null)
                            <div class="my-2 media flex lg:flex-none lg:justify-start justify-center ">
                                <img class="w-full lg:w-1/3 mx-0 lg:mx-auto rounded shadow" src="{{ $post->media }}" alt="">
                            </div>
                        @endif
                    </article>
                    <div class="flex justify-between text-gray-700 text-sm mb-2">
                        <div class="flex-1 "><i class="fas fa-thumbs-up text-blue-500 rounded-full mr-1"></i>{{ count($post->likers(App\User::class)->get()) }}</div>
                        <div class="flex-1 text-right">
                            <a class="text-blue-800" href="{{ route('post.show', $post->id) }}">
                                {{ count($post->replies) }} commentaire{{ (count($post->replies) > 0) ? 's' : null }}
                            </a>
                        </div>
                    </div>
                    <footer class="border-t border-grey-lighter text-sm flex justify-between">
                        <form action="{{ route('post.like', $post->id) }}" method="post" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full block no-underline text-blue px-2 py-2 items-center hover:bg-grey-lighter">
                                @if($post->isLikedBy(auth()->user()->id))
                                    <i class="far fa-thumbs-up text-blue-500"></i>
                                    <span class="text-blue-500">J'aime</span>
                                @else
                                    <i class="far fa-thumbs-up text-gray-700"></i>
                                    <span class="text-gray-700">J'aime</span>
                                @endif
                            </button>
                        </form>
                        <button type="submit" class="flex-1 no-underline text-blue px-2 py-2 items-center hover:bg-grey-lighter">
                            <a href="{{ route('post.show', $post->id) }}">
                                <i class="far fa-comment"></i>
                                <span class="text-gray-700">Répondre</span>
                            </a>
                        </button>
                        <div class="flex-1">
                            <button class="shareButton w-full no-underline text-blue px-2 py-2 items-center hover:bg-grey-lighter">
                                <i class="fas fa-share"></i>
                                <span class="text-gray-700">Partager</span>
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        @endif
    @endif

@endforeach

