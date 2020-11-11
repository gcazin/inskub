<x-page>
    <x-header>
        <x-slot name="title">Gestion de l'école</x-slot>
        @include('school.partials.menu')
    </x-header>

    <x-container>
        <div class="row">
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Professeurs inscrit</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $professors->count() }}</div>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Classes créées</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $classrooms->count() }}</div>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">élèves créées</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $students->count() }}</div>
                </x-section>
            </div>
        </div>
    </x-container>
</x-page>
