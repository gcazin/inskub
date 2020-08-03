<div class="card w-100 border-0 shadow-sm mb-3">
    <div class="card-body p-0">
        <x-form :action="$action" method="post" enctype>
            <div class="row px-3 pt-2">
                <div class="col-2 text-center align-self-center">
                    <img src="{{ \App\User::getAvatar(auth()->id()) }}" class="rounded-circle border border-light" alt=""
                         style="height: 50px">
                </div>
                <div class="col-10">
                    <textarea name="content" class="form-control" placeholder="Ecrivez" autofocus="autofocus"></textarea>
                    <img id="img-preview" class="d-none w-50 mt-3 rounded-lg mx-auto border border-gray" src="#" alt="">
                </div>
            </div>
            <div class="container bg-light">

                <div class="row no-gutters mt-4 py-2">

                    <!-- Visibilité et média -->
                    <div class="col-6">
                        <div class="row no-gutters">
                            <div class="col-8">
                                <select id="visibility" class="form-control" name="visibility_id" id="visibility_id" required>
                                    @foreach(\App\VisibilityPost::all() as $visibilityPost)
                                        <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="custom-file">
                                    <input type="file" name="media" class="custom-file-input" id="img-input">
                                    <label class="custom-file-label text-center" for="img-input">
                                        <ion-icon class="align-text-bottom h5" name="image-outline"></ion-icon>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Publier -->
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary">
                            Publier
                        </button>
                    </div>
                </div>
            </div>
        </x-form>

    </div>
</div>
