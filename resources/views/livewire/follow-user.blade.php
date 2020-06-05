<button wire:click="follow()"
        class="btn btn-outline-{{ auth()->user()->isFollowing($member) ? 'secondary'  : 'primary' }}">
    {!! auth()->user()->isFollowing($member) ? 'Suivi'  : 'Suivre' !!}
</button>

@if (session()->has('follow'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
