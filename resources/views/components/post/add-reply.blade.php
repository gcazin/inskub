<x-section>
    <x-form.item :action="route('post.reply', $post->id)" method="post">
        <div class="row no-gutters">
            <div class="col-1 text-center">
                <img class="rounded-circle" height="35" width="35"
                     src="{{ auth()->user()->getAvatar(auth()->id()) }}" alt="">
            </div>
            <div class="col">
                <input name="message" class="form-control" type="text" placeholder="Votre message">
            </div>
            <div class="col-1 text-center">
                <button class="btn btn-primary" type="submit">Publier</button>
            </div>
        </div>
    </x-form.item>
</x-section>
