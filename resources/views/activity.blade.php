<x-page title="Activité">
    <x-header>
        <x-slot name="title">Activité</x-slot>
    </x-header>

    <x-container>
        <h3 class="mb-4"><ion-icon class="align-text-top text-primary" name="newspaper-outline"></ion-icon> Publications</h3>
        <hr>
        <div class="row text-center mb-4">
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $posts->count() }}</p>
                    <span class="text-muted h4">publications postées</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ auth()->user()->likes()->count() }}</p>
                    <span class="text-muted h4">mentions j'aimes</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ \App\Models\Reply_post::where('user_id', auth()->id())->count() }}</p>
                    <span class="text-muted h4">commentaires postés</span>
                </x-section>
            </div>
        </div>

        <h3 class="mb-3"><ion-icon class="align-text-top text-primary" name="list-outline"></ion-icon> Projets</h3>
        <hr>
        <div class="row text-center mb-3">
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->count() }}</p>
                    <span class="text-muted h4">projets postés</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->where('finish', 0)->count() }}</p>
                    <span class="text-muted h4">projets en cours</span>
                </x-section>
            </div>
            <div class="col-lg-4">
                <x-section>
                    <p class="h2">{{ $projects->where('finish', 1)->count() }}</p>
                    <span class="text-muted h4">projets terminés</span>
                </x-section>
            </div>
        </div>

    </x-container>
</x-page>
