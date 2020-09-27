<?php

use Illuminate\Support\Facades\File;

$user = \App\User::select(['first_name', 'last_name', 'avatar'])->findOrFail($post->user_id);

$extension = File::extension($post->media)
?>
<div
    class="post card rounded-lg mt-3
@if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png' || $extension ===  'gif')
        images
@else
        documents
@endif">

    <div class="card-header bg-white border-0 pb-0">
        <div class="row no-gutters">
            <div class="col-2 col-md-1">
                <img class="rounded-circle" style="height: 40px"
                     src="{{ $user->avatar }}" alt="">
            </div>
            <div class="col-9 col-md-10 pl-2 pl-md-0">
                                    <span class="text-dark font-weight-bold">
                                        {{ $user->first_name }} {{ $user->last_name }}
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
                        @if($post->user_id === auth()->user()->id)
                            <a class="dropdown-item" href="{{ route('post.edit', $post->id) }}">Modifier</a>
                            <x-form :action="route('post.destroy', $post->id)" method="DELETE">
                                <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                            </x-form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body py-0">
        <p id="content">{!! preg_replace('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', '<a href="$0" target="_blank" title="$0">$0</a>', $post->content) !!}</p>
        @if($post->media !== null)
            @if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png' || $extension ===  'gif')
                <img class="w-100 rounded my-2 images" src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->id }}" data-lightbox="image-{{ $post->id }}">
            @else
                <div class="mb-3 rounded-lg border border-primary px-3 py-2">
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($post->media) }}">
                        <ion-icon class="align-text-bottom h5 mb-0" name="document-outline"></ion-icon> {{ \Illuminate\Support\Facades\File::basename($post->media) }}
                    </a>
                </div>
            @endif
        @endif
    </div>

    <div class="card-footer border-0 bg-white p-0">
        <div class="d-flex px-4 py-1">
            <div class="w-50"><ion-icon class="text-primary align-text-bottom" name="thumbs-up"></ion-icon> <span class="text-muted ml-1">{{ $post->likers()->count() }}</span></div>
            <div class="w-50 text-right text-muted">
                <a href="{{ route('post.show', $post->id) }}">
                    {{ $post->replies()->count() }} commentaire{{ $post->replies()->count() > 1 ? 's' : null }}
                </a>
            </div>
        </div>
        <div class="border-top border-gray row text-center no-gutters">
            <div class="btn-group w-100" role="group">
                <livewire:like-post :post="$post" />
                <a href="{{ $link ?? route('post.show', $post->id) }}"
                   class="btn btn-light border-0">
                    <ion-icon class="align-text-bottom" name="chatbox-outline"></ion-icon>
                    Commenter
                </a>
                <button class="share-button btn btn-light border-0" data-link="{{ $link ?? route('post.show', $post->id)}}" data-toggle="modal" data-target="#share-modal" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                    <ion-icon class="align-text-bottom" name="share-social-outline"></ion-icon>
                    Partager
                </button>
            </div>
        </div>

        <div class="bg-white px-1 py-3 rounded shadow-sm">
            <form action="{{ route('post.reply', $post->id) }}" method="post">
                @csrf
                <div class="container px-0">
                    <div class="row no-gutters">
                        <div class="col-lg-1 col-2 text-center">
                            <img class="rounded-circle" height="35" width="35"
                                 src="{{ auth()->user()->getAvatar(auth()->id()) }}" alt="">
                        </div>
                        <div class="col-lg-11 col-10 px-2 align-self-center">
                            <input name="message" class="form-control" type="text" placeholder="Votre message">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
