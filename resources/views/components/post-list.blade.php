<!-- Post -->
<div class="w-100">
    @forelse($model as $post)
        <?php
        $user = \App\User::select(['first_name', 'last_name', 'avatar'])->findOrFail($post->user_id);
        ?>
        <div class="card rounded-lg mt-3">

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
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <p>{{ $post->content }}</p>
                @if($post->media !== null)
                    <img class="w-50 rounded" src="{{ asset('storage/' . $post->media) }}" alt="">
                @endif
            </div>

            <div class="card-footer border-0 bg-white p-0">
                <div class="d-flex px-4 py-1">
                    <div class="w-50"><ion-icon class="text-primary align-text-bottom" name="thumbs-up"></ion-icon> <span class="text-muted ml-1">0</span></div>
                    <div class="w-50 text-right text-muted">0 commentaire</div>
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
    @empty
        <x-alert type="info" icon="information-circle-outline">
            Personne n'a encore publier dans votre espace projet
        </x-alert>
    @endforelse
</div>
