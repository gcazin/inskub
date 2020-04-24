<div class="relative flex-1 bg-white block lg:hidden flex text-gray-600 rounded">
    <div class="order-2">
        <input wire:model="search" id="search" type="search" placeholder="Chercher" class="bg-transparent h-10 px-1 rounded-full text-sm focus:outline-none">
    </div>
    <div class="w-1/12 ml-2 order-1 flex justify-center">
        <button type="submit">
            <i class="fas fa-search text-gray-500"></i>
        </button>
    </div>
    <div id="search-menu" class="hidden absolute shadow w-full bg-white rounded-b transition-all duration-250" style="top: 90%; z-index: 999">
        @foreach($users as $user)
            <a href="{{ route('user.profile', $user->id) }}" class="block px-4 py-2 border-b border-gray-200">
                <img class="h-6 inline-block rounded-full mr-2" src="{{ $user::getAvatar($user->id) }}" alt="">
                {{ $user->last_name }} {{ $user->first_name }}
            </a>
        @endforeach
    </div>
</div>
