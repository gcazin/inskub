<x-page title="Espace emplois">
    <x-header>
        <x-slot name="title">Offres d'emplois proposés</x-slot>
    </x-header>

    <x-container>
        <div class="row">
            <div class="col-lg">
                @include('partials.jobs-list')
            </div>
            <div class="col-lg-8 ml-5" id="show-job"></div>
        </div>
    </x-container>

    <x-slot name="script">
        <script type="module">
            import {showItem} from '{{ asset('js/ajax.js') }}'

            showItem('job')
        </script>
    </x-slot>
</x-page>
