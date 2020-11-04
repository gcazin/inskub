<x-page>
    <x-header>
        <x-slot name="title">Modifier le post</x-slot>
        <x-slot name="content">
            <x-form.item :action="route('post.update', $post->id)" method="put" enctype>
                <x-form.textarea name="content" placeholder="Ecrivez" autofocus="autofocus">{{ $post->content }}</x-form.textarea>
                <img id="img-preview" class="d-none w-50 mt-3 rounded-lg mx-auto border border-gray" src="#" alt="">

                <div class="row w-25">
                    <div class="col">
                        <!-- Visibilité et média -->
                        <select id="visibility" class="form-control" name="visibility_id" id="visibility_id" required>
                            @foreach(\App\Models\VisibilityPost::all() as $visibilityPost)
                                <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" name="media" class="custom-file-input" id="img-input">
                            <label class="custom-file-label text-center" for="img-input">
                                <ion-icon class="align-text-bottom h5" name="image-outline"></ion-icon>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Publier -->
                <x-form.submit>Modifier la publication</x-form.submit>
            </x-form.item>
        </x-slot>
    </x-header>

    <x-container>

    </x-container>
</x-page>
