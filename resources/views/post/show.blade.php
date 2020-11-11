<x-page>
    <x-header>
        <x-slot name="content">
            <x-post.item :post="$post"></x-post.item>
        </x-slot>
    </x-header>

    <x-container>
        <x-post.replies :post="$post"></x-post.replies>

        @auth
        <x-post.add-reply :post="$post"></x-post.add-reply>
        @endauth
    </x-container>
</x-page>

