<x-form.item :action="$action" enctype="multipart/form-data" id="submit-post">
    <div class="mb-4">
        <textarea
            name="content"
            id="form-content"
            class="form-control border-0 focus-none" rows="3" placeholder="Ecrivez" autofocus="autofocus"></textarea>
    </div>
    <img id="img-preview" class="d-none mt-3 rounded-lg mx-auto border border-gray" src="#" alt="" style="width: 300px">

    <hr>
    <div class="row">
        <!-- Visibilité et média -->
        <div class="col-12 col-lg-2">
            <select class="form-control border-0 focus-none" name="visibility_id" id="visibility_id" required>
                @foreach(\App\Models\VisibilityPost::all() as $visibilityPost)
                    <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-6">
            <div class="custom-file">
                <input type="file" name="media" class="custom-file-input" id="media" accept="image/png, image/jpeg, image/gif, application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                <label class="custom-file-label text-left border-0" for="img-input">
                    <span class="btn btn-outline-primary">Importer une image/document</span>
                </label>
            </div>
        </div>

        @if(request()->is('project*'))
            <input type="hidden" id="project_id" name="project_id" value="{{ request()->id }}">
    @endif

    <!-- Publier -->
        <div class="col">
            <x-form.submit id="btn-add">Publier</x-form.submit>
        </div>
    </div>
</x-form.item>

