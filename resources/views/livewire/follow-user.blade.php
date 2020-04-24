<button wire:click="follow()"
        class="btn btn-{{ (App\User::find(auth()->user()->id)->isFollowing($user)) ? 'light'  : 'blue' }}">
    {!!(App\User::find(auth()->user()->id)->isFollowing($user)) ? 'Suivi'  : 'Suivre' !!}
</button>

@if (session()->has('follow'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
