<button wire:click="follow()"
        class="btn btn-{{ (App\User::find(auth()->user()->id)->isFollowing($user)) ? 'secondary'  : 'blue' }}">
    {!!(App\User::find(auth()->user()->id)->isFollowing($user)) ? '<i class="fas fa-check"></i> Suivi'  : 'Suivre' !!}
</button>

@if (session()->has('follow'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
