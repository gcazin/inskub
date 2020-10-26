<nav class="navbar d-none d-lg-block navbar-expand-lg">
    <div class="container px-0">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth <livewire:search-users> @endauth
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    @auth
                        <a class="nav-link pb-0 mt-2" href="{{ route('user.profile', auth()->id()) }}">
                            <ion-icon class="h4 mb-0" name="person-outline"></ion-icon>
                        </a>
                    @endauth
                    @guest
                            <a class="btn text-white btn-lg" href="{{ route('login') }}">
                                Se connecter
                            </a>
                        <a class="btn btn-light btn-lg" href="{{ route('register') }}">
                            S'inscrire
                        </a>
                    @endguest
                </li>
                @auth
                    <li class="nav-item mt-2">
                        <a class="nav-link pb-0 position-relative" href="{{ route('notification.index') }}">
                            <ion-icon class="h4 mb-0" name="notifications-outline"></ion-icon>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <div class="position-absolute top-0" style="top: 0; right: 0">
                                    <span class="badge badge-pill bg-danger text-white">1</span>
                                </div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link pb-0" href="{{ route('user.edit') }}">
                            <ion-icon class="h4 mb-0" name="settings-outline"></ion-icon>
                        </a>
                    </li>
                @endauth
                @auth
                    <li class="nav-item">
                        <div class="dropdown dropnone">
                            <button
                                class="btn dropdown-toggle"
                                type="button" id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <img class="rounded-circle" style="height: 45px;" src="{{ \App\User::getAvatar(auth()->id()) }}" alt="">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
                            </div>
                        </div>
                    </li>
                @endauth
            </ul>
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
                        <img class="img-fluid rounded-circle" style="height: 30px;" src="{{ \App\User::getAvatar(auth()->id()) }}" alt="">
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
