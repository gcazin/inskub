<x-page title="Foire aux questions">
    <x-header>
        <x-slot name="title">FAQ</x-slot>
        <x-slot name="subtitle">Pour répondre aux questions</x-slot>
        <x-slot name="description">
            <div class="container mx-0 px-0">
                <div class="row no-gutters">
                    <div class="col-2">
                        <p class="h5 text-white-50">Total</p>
                        <p class="h1 text-white">{{ $faqs->count() }}</p>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="row">
                <div class="col">
                    <input id="search-users" type="search" placeholder="Rechercher parmis les utilisateurs..." class="form-control" name="search">
                </div>
                @auth
                    @role('super-admin')
                        <div class="col-2">
                            <x-element.link-button size="block" :url="route('admin.faq.index')">Créer une FAQ</x-element.link-button>
                        </div>
                    @endrole
                @endauth
            </div>
        </x-slot>
    </x-header>

    <x-container>
        <x-section>
            <div id="accordion">
                @forelse($faqs as $faq)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    {{$faq->title}}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse-{{ $faq->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                {{$faq->description}}
                            </div>
                        </div>
                    </div>
                    @empty
                    <x-element.alert type="info">
                        <x-slot name="title">Aucune question à afficher.</x-slot>
                    </x-element.alert>
                @endforelse
            </div>
        </x-section>
    </x-container>
</x-page>
