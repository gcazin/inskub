<x-page>
    <x-header>
        <x-slot name="title">{{ $user->followings->count() }} {{  \Illuminate\Support\Str::plural('résultat', $user->followings->count()) }}</x-slot>
    </x-header>

    <x-container>
        <div class="row mb-4">
            @forelse($user->followings as $user)
                <x-user.item :user="$user"></x-user.item>
            @empty
                <x-element.alert type="info" class="d-block">
                    <x-slot name="title">
                        Aucune relation à afficher.
                    </x-slot>
                </x-element.alert>
            @endforelse
        </div>
    </x-container>
</x-page>
