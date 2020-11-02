<x-page>
    <x-container>
        <x-post.item :post="$post"></x-post.item>

        <x-post.replies :post="$post"></x-post.replies>

        <x-post.add-reply :post="$post"></x-post.add-reply>
    </x-container>
</x-page>

