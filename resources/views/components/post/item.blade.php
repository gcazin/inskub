<?php

use App\Models\User;
use Illuminate\Support\Facades\File;

$user = User::find($post->user_id);

$extension = File::extension($post->media)
?>
<x-section :class="e('post rounded-lg bg-white ') . e(isset($animate) === true ?  'animate__animated animate__fadeIn animate__slow' : null)">
    <div class="@if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png' || $extension ===  'gif') images @else documents @endif">
        <div class="row no-gutters">
            <div class="col-lg-1 col-2 col-md-1">
                <img class="rounded-circle" style="height: 40px" src="{{ $user::getAvatar($post->user_id) }}" alt="">
            </div>
            <div class="col col-md-10 pl-2 pl-md-0">
                <span class="text-dark font-weight-bold">{{ $user->first_name }} {{ $user->last_name }}</span>
                <p class="text-muted small">{{ \Carbon\Carbon::make($post->created_at)->diffForHumans() }}</p>
            </div>
            <div class="col-lg-1 col-2 text-right">
                <div class="dropdown dropdown-none">
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
                            <x-form.item :action="route('post.destroy', $post->id)" method="DELETE">
                                <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                            </x-form.item>
                        @else
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target=".post-report">Signaler</button>
                        @endif
                    </div>

                    <x-element.modal title="Signaler un post" name="post-report">
                        <x-form.item :action="route('post.report', $post->id)">
                            <div class="form-group">
                                <label for="reason_id#{{ $post->id }}">Motif du signalement</label>
                                <select class="form-control" name="reason_id" id="reason_id#{{ $post->id }}">
                                    @foreach(\App\Models\Reason::all() as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-form.submit>Signaler le post</x-form.submit>
                        </x-form.item>
                    </x-element.modal>
                </div>
            </div>
        </div>

        <div class="py-3">
            <p id="content" class="mb-0">
                {!! preg_replace('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', '<a href="$0" target="_blank" title="$0">$0</a>', $post->content) !!}
            </p>
            @if($post->media !== null)
                @if($extension === 'jpeg' || $extension === 'jpg' || $extension === 'png' || $extension ===  'gif')
                    <img class="w-25 rounded-lg shadow-sm border border-light my-2 images" src="{{ asset('storage/' . $post->media) }}" alt="{{ $post->id }}" data-lightbox="image-{{ $post->id }}">
                @else
                    <div class="mb-3 rounded-lg border border-primary px-3 py-2">
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($post->media) }}">
                            <ion-icon class="align-text-bottom h5 mb-0" name="document-outline"></ion-icon> {{ \Illuminate\Support\Facades\File::basename($post->media) }}
                        </a>
                    </div>
                @endif
            @endif
        </div>

        <div class="row align-items-center no-gutters py-2">
            <div>
                <livewire:like-post :post="$post" />
            </div>
            <div class="col-1">
                <a href="{{ $link ?? route('post.show', $post->id) }}"
                   class="d-flex justify-content-center align-items-center mx-3" role="button">
                    <ion-icon class="align-middle mb-0 mr-1 text-muted" name="chatbox"></ion-icon> {{ $post->replies()->count() }}
                </a>
            </div>
            <div class="col-1 d-lg-block d-none">
                <button class="share-button btn btn-light btn-sm" data-link="{{ $link ?? route('post.show', $post->id)}}" data-toggle="modal" data-target="#share-modal" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                    <ion-icon class="align-middle mb-0 text-muted" name="share-social"></ion-icon>
                    Partager
                </button>
            </div>
            <div class="col text-right">
                <button class="btn btn-outline-primary btn-sm" id="add-comment-{{ $post->id }}" onclick="addComment({{ $post->id }})" style="cursor: pointer">Ajouter un commentaire</button>
            </div>
        </div>

        <div class="d-none mt-4 animate__animated animate__fadeIn" id="add-comment-form-{{ $post->id }}">
            <form action="{{ route('post.reply', $post->id) }}" method="post">
                @csrf
                <div class="row no-gutters">
                    <div class="mr-3">
                        <img class="rounded-circle" height="35" width="35"
                             src="{{ auth()->user()->getAvatar(auth()->id()) }}" alt="">
                    </div>
                    <div class="col mr-3">
                        <input name="message" class="form-control" type="text" placeholder="Votre message">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</x-section>


