<div class="input-group border-left border-gray">
    <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0" id="basic-addon1">
                        <ion-icon class="h5 mb-0" name="search-outline"></ion-icon>
                    </span>
    </div>
    <input type="search" class="form-control border-0 px-0" wire:model="search" id="search-input" placeholder="Chercher" style="max-width: 30%" autocomplete="off">

    <div id="search-menu" class="d-none overflow-auto position-absolute shadow-sm w-100 bg-white rounded-bottom" style="height: 500px; top: 150%; z-index: 999">
        @forelse($users as $user)
            <a href="{{ route('user.profile', $user->id) }}" class="d-block px-4 py-2 border-bottom">
                <img style="width: 25px;" class="d-inline-block rounded-circle mr-2" src="{{ $user::getAvatar($user->id) }}" alt="">
                {{ $user->last_name }} {{ $user->first_name }}
            </a>
        @empty
        @endforelse
    </div>
</div>
