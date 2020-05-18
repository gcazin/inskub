<button wire:click="follow()"
        class="btn btn-outline-{{ (App\User::find(auth()->user()->id)->isFollowing($user)) ? 'secondary'  : 'primary' }}">
    {!!(App\User::find(auth()->user()->id)->isFollowing($user)) ? 'Suivi'  : 'Suivre' !!}
</button>

@if (session()->has('follow'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
