<x-page>
    @if(session()->has('thanks_report'))
        <x-element.toast title="Signalement envoyé" type="success" name="thanks_report">Merci de votre signalement</x-element.toast>
    @endif

    <x-slot name="title">Fil d'actualité</x-slot>

    <x-header>
        <x-slot name="title">Fil d'actualité</x-slot>

        <x-slot name="content">
            <x-post.submit :action="route('index')"></x-post.submit>
        </x-slot>
    </x-header>

    <x-container>
        <x-post.list :model="$posts"></x-post.list>
    </x-container>

    <x-element.loading></x-element.loading>

    <x-slot name="script">
        <script type="module">
            import { loadMoreDataInfinite } from '{{ asset('js/ajax.js') }}'

            loadMoreDataInfinite('/index', 'post-list')
        </script>
        <script type="module">
            import { submitPost } from '{{ asset('js/ajax.js') }}'

            submitPost('/index')
        </script>
        <script>
            function displayPreview(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-preview').removeClass('d-none')
                        $('#img-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#media").change(function(){
                displayPreview(this);
            });
        </script>
    </x-slot>
</x-page>
