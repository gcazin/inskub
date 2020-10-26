<div class="col-3 mb-3 text-center">
    <div class="bg-white shadow-sm rounded-lg p-4">

        <!-- Profile picture -->
        <div class="mb-4">
            <a href="{{ route('user.profile', $user->id) }}">
                <img style="height: 80px" class="rounded-lg border border-light" src="{{ $user->getAvatar($user->id) }}" alt="">
            </a>
        </div>

        <div class="mb-4">
            <a href="{{ route('user.profile', $user->id) }}" class="h5 text-primary">
                {{ $user->first_name }} {{ $user->last_name }}
            </a>
        </div>

        <div class="mb-4">
            <div class="row">
                <div class="col">
                    <p class="text-black-50">Publications</p>
                    <p class="text-primary h4">{{ $user->posts->count() }}</p>
                </div>
                <div class="col">
                    <p class="text-black-50">Abonnés</p>
                    <p class="text-primary h4">{{ $user->followers->count() }}</p>
                </div>
                <div class="col">
                    <p class="text-black-50">Abonnements</p>
                    <p class="text-primary h4">{{ $user->followings->count() }}</p>
                </div>
            </div>
        </div>

        <x-link-button :url="route('user.profile', $user->id)" type="outline-primary">Voir le profil</x-link-button>

    </div>
</div>
