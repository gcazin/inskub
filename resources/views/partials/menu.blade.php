<nav class="d-none d-lg-block navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid px-10">
        <div class="collapse navbar-collapse row no-gutters" id="navbarSupportedContent">

            <div class="col">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col d-flex justify-content-center">
                @auth
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item {{ request()->is('index*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('index') }}">Accueil</a>
                        </li>
                        <li class="nav-item {{ request()->is('discover*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('discover.index') }}">Découvrir</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('expert*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3 d-flex align-items-center" style="font-size: 1.2rem" href="#" id="expertDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(\App\Models\RequestExpertise::where('expert_id', auth()->id())->where('status', '=', 0)->get()->count() > 0)
                                    <div class="spinner-grow text-primary spinner-grow-sm mr-2" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                @endif
                                Sinistre
                            </a>
                            <div class="dropdown-menu shadow-sm rounded-lg border-0 mt-3" aria-labelledby="expertDropdown">
                                @hasrole('intermediate')
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('expert.missions') }}">
                                    <ion-icon name="search-outline" class="h5 mb-0 align-text-bottom mr-3 icon-container-primary"></ion-icon>
                                    Missions d'expertise
                                </a>
                                @else
                                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('expert.index') }}">
                                        <ion-icon name="folder-open-outline" class="h5 mb-0 align-text-bottom mr-3 icon-container-primary"></ion-icon>
                                        Ouvrir un sinistre
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('sinister.index') }}">
                                        <ion-icon name="eye-outline" class="h5 mb-0 align-text-bottom mr-3 icon-container-primary"></ion-icon>
                                        Suivre un sinistre
                                    </a>
                                    <!--<a class="dropdown-item d-flex align-items-center py-2" href="#">
                                        <ion-icon name="search-outline" class="h5 mb-0 align-text-bottom mr-3 icon-container-primary"></ion-icon>
                                        Retrouver un sinistre
                                    </a>-->
                                    @endhasrole
                            </div>
                        </li>
                        <li class="nav-item {{ request()->is('project*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('project.index') }}">Projet</a>
                        </li>
                        <li class="nav-item {{ request()->is('chat*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('chat.show') }}">Messagerie</a>
                        </li>
                        @role('super-admin|admin')
                        <li class="nav-item {{ request()->is('admin*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('admin.index') }}">Administration</a>
                        </li>
                        @endrole
                    </ul>
                @endauth
            </div>

            <div class="col d-flex justify-content-end">
                <ul class="navbar-nav ml-auto">
                    <li>
                        @guest
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">
                                Se connecter
                            </a>
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                S'inscrire
                            </a>
                        @endguest
                    </li>
                    @auth
                        <li class="nav-item">
                            <div class="dropdown dropdown-none">
                                <button
                                    class="btn focus-none dropdown-toggle"
                                    type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <img class="rounded-circle" style="height: 45px;" src="{{ \App\Models\User::getAvatar(auth()->id()) }}" alt="">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right mt-3 border-0 rounded-lg shadow-sm" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.profile', auth()->id()) }}">Mon profil</a>
                                    <a class="dropdown-item" href="{{ route('notification.index') }}">Notifications</a>
                                    <a class="dropdown-item" href="{{ route('user.options') }}">Réglages</a>
                                    <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
                                </div>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar d-lg-none navbar-light bg-white shadow-sm mb-3">
    <div class="container-fluid px-0">
        <a class="navbar-brand" href="#">
            <img style="width: 50px" src="{{ asset('storage/images/favicon-96x96.png') }}" alt="">
        </a>
        <div class="d-flex">
            @auth
                <a class="nav-link pr-0" href="{{ route('notification.index') }}">
                    <ion-icon class="h4 mb-0" name="notifications-outline"></ion-icon>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="position-absolute top-0" style="top: 0; right: 0">
                            <span class="badge badge-pill bg-danger text-white">1</span>
                        </div>
                    @endif
                </a>
            @endauth
            <div class="dropdown dropnone">
                <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    @auth
                        <img class="img-fluid rounded-circle" style="height: 30px;" src="{{ \App\Models\User::getAvatar(auth()->id()) }}" alt="">
                    @endauth
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    @auth
                        <a class="dropdown-item" href="{{ route('user.profile', auth()->id()) }}">Profil</a>
                        <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
