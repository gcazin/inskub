<x-page>
    <x-header>
        <x-slot name="title">{{ $user->followers->count() }} {{  \Illuminate\Support\Str::plural('résultat', $user->followers->count()) }}</x-slot>
    </x-header>

    <x-container>
        <div class="row mb-4">
            @forelse($user->followers as $user)
                <x-user.item :user="$user"></x-user.item>
            @empty
                <x-element.alert type="info" class="w-100">
                    <x-slot name="title">
                        Aucune relation à afficher.
                    </x-slot>
                </x-element.alert>
            @endforelse
        </div>
    </x-container>
</x-page>
