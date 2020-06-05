<x-container>
    <h4 class="text-muted mb-3">Informations du compte</h4>

    @include('user.partials.nav')

    <x-section>
        <p class="h4">{{ $title }}</p>
        <hr>

        {{ $slot }}
    </x-section>
</x-container>

<x-right-sidebar-message></x-right-sidebar-message>
