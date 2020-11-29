<x-page title="Accueil">

    <x-container class="mx-5 mx-lg-0">
        <div class="row my-5 py-10 justify-content-center align-items-center">
            <div class="col">
                <h1 style="font-size: 4.5vw" class="text-primary mb-4">
                    <span class="font-weight-bold">Connecter</span> le monde de l'assurance
                </h1>
                <p class="text-muted h4 font-weight-bold mb-4">
                    La manière la plus simple de créer, voir, et partager au sein du domaine assurantiel.
                </p>
                <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Créer votre compte</a>
            </div>
            <div class="col d-none d-lg-block row bg-blue-200 py-5 rounded-lg ml-10">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner text-center">
                        <div class="carousel-item active">
                            <img class="rounded-lg shadow w-75" src="{{ asset('storage/images/espace-projet.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded-lg shadow w-75" src="{{ asset('storage/images/recherche-expert.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded-lg shadow w-75" src="{{ asset('storage/images/decouvrir.png') }}" alt="Third slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-3 pb-10 text-center">
            <div class="col">
                <x-section>
                    <p class="h1 text-primary">{{ \App\Models\User::all()->count() }}</p>
                    <span class="text-muted h5">utilisateurs inscrits</span>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <p class="h1 text-primary">{{ \App\Models\Post::all()->count() }}</p>
                    <span class="text-muted h5">publications postées</span>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <p class="h1 text-primary">{{ \App\Models\User::role('expert')->get()->count() }}</p>
                    <span class="text-muted h5">experts inscrits</span>
                </x-section>
            </div>
        </div>

        <div class="pb-10 text-center">
            <h1 class="text-primary">Découvrer le monde de l'assurance comme vous ne l'avez jamais connu</h1>
        </div>

        <div class="row row-cols-1 row-cols-lg-3 pb-5">
            <div class="col">
                <x-section>
                    <p class="text-primary h2"><ion-icon class="icon-container-primary" name="search-outline"></ion-icon></p>
                    <p class="h4 mb-3">Trouver</p>
                    <span class="text-muted text-justify h5">Un emploi, une formation, une alternance, ou encore un stage, <span class="font-weight-bold">Inskub</span> vous permet de trouver ce que vous cherchez !</span>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <p class="text-primary h2"><ion-icon class="icon-container-primary" name="create-outline"></ion-icon></p>
                    <p class="h4 mb-3">Créer</p>
                    <span class="text-muted h5">Une envie de partager une pensée, créer un projet, ou bien encore de publier une offre d'emploi, c'est possible !</span>
                </x-section>
            </div>
            <div class="col">
                <x-section>
                    <p class="text-primary h2"><ion-icon class="icon-container-primary" name="grid-outline"></ion-icon></p>
                    <p class="h4">Centraliser</p>
                    <span class="text-muted h5">Pour les écoles, une gestion poussée de votre activité est disponible avec de nombreuses fonctionnalités à découvrir.</span>
                </x-section>
            </div>
        </div>
    </x-container>
</x-page>
