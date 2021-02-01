<x-page title="Projets">
    <x-header>
        <x-slot name="title">Récapitulatif des compte-rendus d'expertise</x-slot>

        <x-slot name="content">
            <div class="row">
                <div class="col flex-wrap" id="project-list">
                    @forelse($reports as $report)
                        <div class="px-3 py-4 shadow-sm rounded-lg position-relative bg-white">
                            <div class="row align-items-center">
                                <div class="col col-lg-5 h5 text-secondary">
                                    Consulter le compte rendu du projet <span class="text-primary">"{{ \App\Models\Project::find($report->project->id)->title }}"</span>
                                </div>
                                <a href="{{ asset('storage/expertise/'.$report->media) }}" class="position-absolute h-100 w-100" style="top: 0; bottom: 0; left: 0; right: 0"></a>
                            </div>
                        </div>
                    @empty
                        <x-element.alert type="info">
                            <x-slot name="title">
                                Aucun compte-rendu n'a encore été publié
                            </x-slot>
                        </x-element.alert>
                    @endforelse
                </div>
            </div>
        </x-slot>
    </x-header>

</x-page>
