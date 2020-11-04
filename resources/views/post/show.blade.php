<x-page>
    <x-header>
        <x-slot name="content">
            <x-post.item :post="$post"></x-post.item>
        </x-slot>
    </x-header>

    <x-container>
        <x-post.replies :post="$post"></x-post.replies>

        <x-post.add-reply :post="$post"></x-post.add-reply>
    </x-container>
</x-page>

