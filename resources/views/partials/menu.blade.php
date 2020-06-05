<nav class="navbar d-none d-lg-block navbar-expand-lg navbar-light bg-white border-bottom border-gray">
    <div class="container-fluid px-0">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img style="width: 50px" src="{{ asset('storage/images/logo.png') }}" alt="">{{ env('APP_NAME') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="input-group border-left border-gray">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0" id="basic-addon1">
                        <ion-icon class="h5 mb-0" name="search-outline"></ion-icon>
                    </span>
                </div>
                <input type="text" class="form-control border-0 px-0" placeholder="Chercher sur le site" aria-label="Username" aria-describedby="basic-addon1" style="max-width: 30%">
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mt-2">
                    <a class="nav-link pb-0" href="{{ route('user.profile', auth()->id()) }}">
                        <ion-icon class="h4 mb-0" name="person-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link pb-0" href="{{ route('user.edit') }}">
                        <ion-icon class="h4 mb-0" name="settings-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="dropdown dropnone">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" style="height: 45px;"
                                 src="{{ \App\User::getAvatar(auth()->id()) }}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('user.profile', auth()->id()) }}">Profil</a>
                            <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar d-lg-none navbar-light bg-white shadow-sm mb-3">
    <div class="container-fluid px-0">
        <a class="navbar-brand" href="#"><img style="width: 50px" src="{{ asset('storage/images/logo.png') }}" alt=""></a>
        <div class="dropdown dropnone">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid rounded-circle" style="height: 30px;"
                     src="{{ \App\User::getAvatar(auth()->id()) }}" alt="">
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>
