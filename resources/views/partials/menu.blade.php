<nav class="d-none d-lg-block navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid px-10 @guest py-2 @endguest">
        <div class="collapse navbar-collapse row no-gutters" id="navbarSupportedContent">

            <div class="col">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img style="width: 130px" src="{{ asset('storage/images/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col d-flex justify-content-center">
                @auth
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item {{ request()->is('discover*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('discover.index') }}">Découvrir</a>
                        </li>
                        @if(auth()->user()->can('sinister.*') || auth()->user()->can('expert.*'))
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
                                    @can('sinister.*')
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('expert.missions') }}">
                                            <ion-icon name="search-outline" class="h5 mb-0 align-text-bottom mr-3 icon-container-primary"></ion-icon>
                                            Missions d'expertise
                                        </a>
                                    @endcan
                                    @can('expert.*')
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
                                    @endcan
                                </div>
                            </li>
                        @endif
                        <li class="nav-item {{ request()->is('project*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('project.index') }}">Projet</a>
                        </li>
                        <li class="nav-item {{ request()->is('chat*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('chat.show') }}">Messagerie</a>
                        </li>
                        @can('professor.*|class.*')
                            <li class="nav-item {{ request()->is('school*') ? 'active' : null }}">
                                <a class="nav-link px-4 py-3" style="font-size: 1.2rem" href="{{ route('school.index') }}">Gestion</a>
                            </li>
                        @endcan
                        @role('super-admin|admin')
                        <li class="nav-item {{ request()->is('admin*') ? 'active' : null }}">
                            <a class="nav-link px-4 py-3 text-primary" style="font-size: 1.2rem" href="{{ route('admin.index') }}">
                                <span>Administration</span>
                            </a>
                        </li>
                        @endrole
                    </ul>
                @endauth
            </div>

            <div class="col d-flex justify-content-end">
                <ul class="navbar-nav ml-auto">
                    <li>
                        @guest
                            <a class="btn btn-primary" href="{{ route('login') }}">
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
                                    <span class="text-muted align-middle mr-2">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                                    <img class="rounded-circle" style="height: 45px;" src="{{ auth()->user()::getAvatar(auth()->id()) }}" alt="">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right mt-3 border-0 rounded-lg shadow-sm" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.profile', auth()->id()) }}">Mon profil</a>
                                    <a class="dropdown-item" href="{{ route('user.activity') }}">Activité</a>
                                    <a class="dropdown-item" href="{{ route('notification.index') }}">Notifications</a>
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

<nav class="navbar d-block d-lg-none navbar-light bg-white shadow-sm mb-3">
    <div class="container-fluid px-0">
        <a class="navbar-brand" href="#">
            <img style="width: 50px" src="{{ asset('storage/images/favicon-96x96.png') }}" alt="">
        </a>
        <div class="d-flex">
            @guest
                <div>
                    <a class="btn btn-primary" href="{{ route('login') }}">
                        Se connecter
                    </a>
                    <a class="btn btn-primary" href="{{ route('register') }}">
                        S'inscrire
                    </a>
                </div>
            @endguest
            @auth
                <a class="nav-link position-relative pr-0" href="{{ route('notification.index') }}">
                    <ion-icon class="h4 mb-0 align-middle" name="notifications-outline"></ion-icon>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="position-absolute top-0" style="top: 0; right: 0">
                            <span class="badge badge-pill bg-danger text-white">1</span>
                        </div>
                    @endif
                </a>
                <div class="dropdown dropnone">
                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <img class="img-fluid rounded-circle" style="height: 30px;" src="{{ auth()->user()::getAvatar(auth()->id()) }}" alt="">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('user.profile', auth()->id()) }}">Profil</a>
                        <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
