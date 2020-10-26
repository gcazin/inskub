<div class="add-comment-form-{{ $post }} px-1 py-3 rounded shadow-sm">
    <form action="{{ route('post.reply', $post) }}" method="post">
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
