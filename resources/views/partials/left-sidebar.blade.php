<div class="position-sticky d-none d-lg-flex flex-column rounded-lg col-lg-2 mt-1" style="border: 7px solid transparent">
    <div class="py-3 bg-white shadow-sm border rounded-lg">
        <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Menu</h6>
        @if(request()->is('project/*'))
            <div class="d-flex flex-column pb-3">
                <a class="menu-item" href="{{ route('index') }}">
                    <ion-icon class="h4 align-top mr-1" name="home-outline"></ion-icon> Accueil
                </a>
                <a class="menu-item" href="{{ route('discover') }}">
                    <ion-icon class="h4 align-top mr-1" name="apps-outline"></ion-icon> Découvrir
                </a>
                <a class="menu-item" href="{{ route('chat.index') }}">
                    <ion-icon class="h4 align-top mr-1" name="chatbubbles-outline"></ion-icon> Messagerie
                </a>
            </div>
            <div class="d-flex flex-column pb-3">
                <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Projet</h6>
                <a class="menu-item" href="{{ route('chat.index') }}">
                    <ion-icon class="h4 align-top mr-1" name="albums-outline"></ion-icon> Tâches
                </a>
            </div>

        @else
            <div class="d-flex flex-column pb-3">
                <a class="menu-item {{ request()->is('/') ? 'active' : null }}" href="{{ route('index') }}">
                    <ion-icon class="h4 align-top mr-1" name="home-outline"></ion-icon> Accueil
                </a>
                <a class="menu-item {{ request()->is('discover') ? 'active' : null }}" href="{{ route('discover') }}">
                    <ion-icon class="h4 align-top mr-1" name="apps-outline"></ion-icon> Découvrir
                </a>
                <a class="menu-item {{ request()->is('projects') ? 'active' : null }}" href="{{ route('project.index') }}">
                    <ion-icon class="h4 align-top mr-1" name="list-outline"></ion-icon> Projet
                </a>
            </div>
        @endif
        <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Options</h6>
        <div class="d-flex flex-column pb-3">
            <a class="menu-item" href="{{ route('user.profile', auth()->id()) }}">
                Notifications
            </a>
            <a class="menu-item" href="{{ route('user.options') }}">
                Réglages
            </a>
        </div>
    </div>
    <div class="align-self-end">

    </div>
</div>
