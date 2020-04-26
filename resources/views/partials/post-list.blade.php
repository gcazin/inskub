<div class="section">
    <div class="row no-gutters align-items-center">

        <div class="card w-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-1 text-center">
                        <img src="{{ \App\User::getAvatar(auth()->id()) }}" class="rounded-circle" alt=""
                             style="height: 50px">
                    </div>
                    <div class="col-11">
                        <button type="button" class="btn btn-light btn-block rounded-pill" data-toggle="modal"
                                data-target="#createPost">
                            Partager à votre réseau
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Créer une publication</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('post.create') }}">
                        <div class="container-fluid">
                            <div class="row py-3 align-items-center">
                                <div class="col-1">
                                    <img src="{{ \App\User::getAvatar(auth()->id()) }}" class="rounded-circle" style="height: 40px" alt="">
                                </div>
                                <div class="col-11 text-secondary pl-4">
                                    {{ ucfirst(auth()->user()->first_name) }} {{ ucfirst(auth()->user()->last_name) }}
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="form-group h3">
                            <textarea type="text" class="form-control rounded-0 border-0" placeholder="Ecrivez" autofocus="autofocus"></textarea>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">Partager</div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <select class="form-control" id="visibility_id">
                                            @foreach(\App\VisibilityPost::all() as $visibilityPost)
                                                <option value="{{ $visibilityPost->id }}"><ion-icon name="add-outline"></ion-icon> {{ $visibilityPost->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-block">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Post -->
    <div class="w-100">
        @foreach($posts->sortByDesc('created_at') as $post)
            @if($post->user_id === auth()->id() || auth()->user()->isFollowing($post->user_id))
                @if($post->visibility_id !== 3 || $post->user_id === auth()->id())
                    <div class="card rounded-lg mt-3">

                        <div class="card-header bg-white">
                            <div class="row no-gutters">
                                <div class="col-2">
                                    <img class="rounded-circle" style="height: 50px"
                                         src="{{ $user::getAvatar($post->user_id) }}" alt="">
                                </div>
                                <div class="col-9 pl-2">
                                    <span class="text-dark font-weight-bold">
                                        {{ $user::find($post->user_id)->first_name }} {{ $user::find($post->user_id)->last_name }}
                                        </span>
                                    <p class="text-muted"
                                       style="font-size: .8rem">{{ \Carbon\Carbon::make($post->created_at)->diffForHumans() }}</p>
                                </div>
                                <div class="col-1 text-right">
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

                        <div class="card-body">{{ $post->content }}</div>

                        <div class="card-footer bg-white p-0">
                            <div class="row text-center no-gutters">
                                <div class="btn-group w-100" role="group">
                                    <a class="btn btn-light bg-white border-0">
                                        <ion-icon name="heart-outline"></ion-icon>
                                        J'aime</a>
                                    <a href="{{ route('post.show', $post->id) }}"
                                       class="btn btn-light bg-white border-0">
                                        <ion-icon name="chatbox-outline"></ion-icon>
                                        Commenter</a>
                                    <a class="btn btn-light bg-white border-0">
                                        <ion-icon name="share-social-outline"></ion-icon>
                                        Partager</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>

