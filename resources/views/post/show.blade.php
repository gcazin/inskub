@extends('layouts.base', ['header' => false])

@section('content')
    <div class="col-lg-6 offset-lg-1 p-lg-3">
        <div class="card rounded-lg">

            <div class="card-header bg-white border-0 pb-0">
                <div class="row no-gutters">
                    <div class="col-2 col-md-1">
                        <img class="rounded-circle" style="height: 40px"
                             src="{{ \App\User::getAvatar($post->user_id) }}" alt="">
                    </div>
                    <div class="col-9 col-md-10 pl-2 pl-md-0">
                                    <span class="text-dark font-weight-bold">
                                        {{ \App\User::find($post->user_id)->first_name }} {{ \App\User::find($post->user_id)->last_name }}
                                        </span>
                        <p class="text-muted"
                           style="font-size: .8rem">{{ \Carbon\Carbon::make($post->created_at)->diffForHumans() }}</p>
                    </div>
                    <div class="col-1 col-md-1 text-right">
                        <div class="dropdown dropnone">
                            <button class="btn rounded-circle dropdown-toggle"
                                    type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <p id="content">{!! preg_replace('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', '<a href="$0" target="_blank" title="$0">$0</a>', $post->content) !!}</p>
                @if($post->media !== null)
                    <img class="w-50 rounded my-2" src="{{ asset('storage/' . $post->media) }}" alt="">
                @endif
            </div>

            <div class="card-footer border-0 bg-white p-0">
                <div class="d-flex px-4 py-1">
                    <div class="w-50"><ion-icon class="text-primary align-text-bottom" name="thumbs-up"></ion-icon> <span class="text-muted ml-1">{{ $post->likers()->count() }}</span></div>
                    <div class="w-50 text-right text-muted">
                        {{ $post->replies()->count() }} commentaire{{ $post->replies()->count() > 1 ? 's' : null }}
                    </div>
                </div>
                <div class="border-top border-gray row text-center no-gutters">
                    <div class="btn-group w-100" role="group">
                        <a class="btn btn-light border-0">
                            <ion-icon class="align-text-bottom" name="thumbs-up-outline"></ion-icon>
                            J'aime
                        </a>
                        <a href="{{ route('post.show', $post->id) }}"
                           class="btn btn-light border-0">
                            <ion-icon class="align-text-bottom" name="chatbox-outline"></ion-icon>
                            Commenter
                        </a>
                        <button class="share-button btn btn-light border-0">
                            <ion-icon class="align-text-bottom" name="share-social-outline"></ion-icon>
                            Partager
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commentaires -->
        <div class="bg-white p-3">
            <p class="text-sm">Commentaires</p>
            @if(count($post->replies) > 0)
                @foreach($post->replies as $reply)
                    <div class="container mb-3">
                        <div class="row no-gutters">
                            <div class="col-1">
                                <img class="rounded-circle" height="35" width="35"
                                     src="{{ auth()->user()->getAvatar($reply->user_id) }}" alt="">
                            </div>
                            <div class="col-11 bg-light rounded border px-3 py-2">
                                <a href="{{ route('user.profile', $reply->user_id) }}"
                                   class="text-blue-800 hover:underline focus:underline" class="text-sm font-bold">
                                    {{ \App\User::find($reply->user_id)->first_name }} {{ \App\User::find($reply->user_id)->last_name }}
                                </a>
                                <p class="mb-0">{{ $reply->message }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <x-alert type="info">
                    Aucun élément à afficher, soyez la première personne à publier un commentaire.
                </x-alert>
            @endif
        </div>
        <div class="bg-white px-1 py-2 rounded shadow-sm">
            <form action="{{ route('post.reply', $post->id) }}" method="post">
                @csrf
                <div class="container px-0">
                    <div class="row no-gutters">
                        <div class="col-1 text-center">
                            <img class="rounded-circle" height="35" width="35"
                                 src="{{ auth()->user()->getAvatar(auth()->id()) }}" alt="">
                        </div>
                        <div class="col-9">
                            <input name="message" class="form-control" type="text" placeholder="Votre message">
                        </div>
                        <div class="col-2 text-center">
                            <button class="btn text-primary" type="submit">Publier</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
