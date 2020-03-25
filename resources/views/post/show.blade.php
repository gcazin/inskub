@extends('layouts.base', ['header' => false])

@section('content')
    @auth
        <!-- Post -->
        <div class="bg-white mx-auto border border-grey-light overflow-hidden">
            <div class="flex w-11/12 mx-auto flex-col">
                <div class="pt-1 flex-grow">
                    <div class="flex items-center justify-center">
                        <div class="mr-3">
                            <img class="rounded-full" height="40" width="40" src="{{ auth()->user()->getAvatar($post->user_id) }}">
                        </div>
                        <div class="flex-1 my-1">
                            <span class="font-bold">{{ App\User::all()->find($post->user_id)->name }}</span>
                            <div class="text-xs text-gray-600 flex items-center">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <article class="pt-3 pb-5 px-2 text-grey-darkest">
                        {{ $post->content }}
                    </article>
                    <div class="flex justify-between text-gray-700 text-sm mb-2">
                        <div class="flex-1 "><i class="fas fa-thumbs-up text-blue-500 rounded-full mr-1"></i>{{ count($post->likers(User::class)->get()) }}</div>
                        <div class="flex-1 text-right">{{ count($post->replies) }} commentaire{{ (count($post->replies) > 0) ? 's' : null }}</div>
                    </div>
                    <footer class="border-t border-grey-lighter text-sm flex justify-between">
                        <form action="{{ route('like.post', $post->id) }}" method="post" class="flex-1">
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
                        <form action="{{ route('like.post', $post->id) }}" method="post" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full no-underline text-blue px-2 py-2 items-center hover:bg-grey-lighter">
                                <i class="far fa-comment"></i>
                                <span class="text-gray-700">Répondre</span>
                            </button>
                        </form>
                        <div class="flex-1">
                            <button class="w-full no-underline text-blue px-2 py-2 items-center hover:bg-grey-lighter">
                                <a href="#" class="text-gray-700">
                                    <i class="fas fa-share"></i>
                                    <span class="text-gray-700">Partager</span>
                                </a>
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <div class="bg-white">
            <div class="w-11/12 mx-auto overflow-x-auto" style="max-height: 40vh">
                <p class="mt-2 text-sm">Commentaires</p>
                @foreach($post->replies as $reply)
                <div class="flex my-5">
                    <div class="" >
                        <img class="rounded-full" height="30" width="30" src="{{ auth()->user()->getAvatar($post->user_id) }}" alt="">
                    </div>
                    <div class="flex-1 px-2 bg-gray-200 ml-3 rounded-lg shadow-sm">
                        <p>{{ $reply->message }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="reply pb-2 w-11/12 mx-auto">
                <form action="{{ route('store.reply-post', $post->id) }}" method="post">
                    @csrf
                    <div class="flex">
                        <div class="self-center mr-2">
                            <img class="rounded-full" height="30" width="30" src="{{ auth()->user()->getAvatar($post->user_id) }}" alt="">
                        </div>
                        <div class="flex-1 form-group">
                            <input name="message" class="input" type="text" placeholder="Votre message">
                        </div>
                        <div class="form-group self-center text-blue-700 font-extrabold">
                            <button class="btn" type="submit">Publier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endauth

@endsection
