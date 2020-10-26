<x-form :action="$action" method="post" enctype>
    <div class="mb-4">
        <textarea
            name="content"
            id="form-content"
            class="form-control border-0 focus-none" rows="3" placeholder="Ecrivez" autofocus="autofocus"></textarea>
    </div>
    <img id="img-preview" class="d-none w-50 mt-3 rounded-lg mx-auto border border-gray" src="#" alt="">


    <hr>
    <div class="row">
        <!-- Visibilité et média -->
        <div class="col">
            <select class="form-control border-0 focus-none" name="visibility_id" id="visibility_id" required>
                @foreach(\App\VisibilityPost::all() as $visibilityPost)
                    <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col pl-1">
            <div class="custom-file">
                <input type="file" name="media" class="custom-file-input" id="img-input">
                <label class="custom-file-label text-left border-0" for="img-input">
                    <ion-icon class="align-text-bottom h3 text-muted" name="image-outline"></ion-icon>
                </label>
            </div>
        </div>

        @if(request()->is('project*'))
            <input type="hidden" id="project_id" name="project_id" value="{{ request()->id }}">
    @endif

    <!-- Publier -->
        <div class="col-9 text-right">
            <button id="btn-add" type="button" class="btn btn-primary">
                Publier
            </button>
        </div>
    </div>
</x-form>

