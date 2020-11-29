<x-page title="Espace formations">
    <x-header>
        <x-slot name="title">Formations proposées</x-slot>
    </x-header>

    <x-container>
        <div class="row">
            <div class="col-lg">
                @include('partials.formations-list')
            </div>
            <div class="col-lg-8 ml-5" id="show-formation"></div>
        </div>
    </x-container>

    <x-slot name="script">
        <script type="module">
            import {showItem} from '{{ asset('js/ajax.js') }}'

            showItem('formation')
        </script>
    </x-slot>
</x-page>
