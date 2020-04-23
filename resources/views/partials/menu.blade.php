@php

    use Illuminate\Support\Facades\Route;

    //TODO: Faire un checker de route globale à tous le projet
    function routeName($name) {
        return (Route::currentRouteName() == $name) ? ("active") : null;
    }

@endphp

<div class="lg:py-0">
    <nav class="flex items-center justify-between flex-wrap w-11/12 m-auto py-3">
        <livewire:search-users>
            @auth
                <div class="ml-2 block lg:hidden flex justify-end">
                    <button id="userButton"
                            class="flex items-center focus:outline-none text-gray-600 hover:text-blue-500">
                        <img class="w-10 h-10 rounded-full" src="{{ \App\User::getAvatar(auth()->user()->id) }}"
                             alt="Avatar of User">
                    </button>
                </div>
            @endauth
            <div class="hidden lg:flex align-center flex-shrink-0 text-black">
                <a href="{{ route('post.index') }}" class="font-medium text-2xl text-gray-700 dark:text-gray-200">
                    <img class="h-8 inline-block align-baseline" src="{{ asset('storage/images/logo.png') }}"
                         alt="Logo">
                    <span class="align-text-bottom">TomorrowInsurance</span>
                </a>
                <div class="ml-2 flex rounded text-gray-600  ">
                    <a href="{{ route('discover') }}"
                       class="rounded-lg px-3 py-2 hover:bg-gray-200 hover:text-gray-800 mr-2 transition-all duration-250">
                        Découvrir
                    </a>
                @auth
                    @if(auth()->user()->role_id === 1) <!-- Admin -->
                        <a href="{{ route('discover') }}"
                           class="rounded-lg px-3 py-2 hover:bg-gray-200 hover:text-gray-800 mr-4 transition-all duration-250">Découvrir</a>
                    @elseif(auth()->user()->role_id === 2) <!-- Salarié -->
                        <a class="pr-3 mx-4 btn btn-blue" href="{{ route('formation.index') }}">Trouver une
                            formation</a>
                    @elseif(auth()->user()->role_id === 4) <!-- Ecole -->
                        <a href="{{ route('discover') }}" class=" dark:text-gray-200">Découvrir</a>
                    @elseif(auth()->user()->role_id === 5) <!-- Etudiant -->
                        <a class="rounded-lg px-3 py-2 hover:bg-gray-200 hover:text-gray-800 mr-4 transition-all duration-250"
                           href="{{ route('job.index') }}">Offres d'emploi</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div id="main-nav"
                 class="w-full text-xl font-medium hidden lg:inline flex-grow lg:flex lg:justify-end lg:w-auto">
                <div class="w-full lg:w-1/2 pr-0 mt-2 md:mt-0">
                    <div class="flex relative inline-block items-center justify-end sm:mt-3 lg:mt-0">
                        @auth
                            <a class="mr-2 relative text-gray-600 border-solid border-gray-200 hover:text-blue-500"
                               href="{{ route('chat.index') }}">
                                <ion-icon class="align-middle text-3xl" name="chatbox-outline"></ion-icon>
                            </a>
                            @if(auth()->user()->role_id === 1) <!-- Admin -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('admin.index') }}">Administration</a>
                            @elseif(auth()->user()->role_id === 2) <!-- Salarié -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('formation.index') }}">Trouver une
                                formation</a>
                            @elseif(auth()->user()->role_id === 3) <!-- Entreprise -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('job.create') }}">Proposer une offre
                                d'emploi</a>
                            @elseif(auth()->user()->role_id === 4) <!-- Ecole -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('formation.create') }}">Proposer une
                                formation</a>
                            @endif
                            <div class="relative text-sm">

                                <div x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false"
                                     class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button"
                                                class="transition ease-in-out duration-150">
                                            <img class="w-10 h-10 rounded-full"
                                                 src="{{ \App\User::getAvatar(auth()->user()->id) }}"
                                                 alt="Avatar of User">
                                        </button>
                                    </div>
                                    <div
                                        x-show="open"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95" class="dropdown">
                                        <div class="rounded-md bg-white shadow-xs">
                                            <div class="py-1">
                                                <a href="{{ route('user.profile', auth()->id()) }}" class="dropdown-item">
                                                    Mon compte
                                                </a>
                                            </div>
                                            <div class="border-t border-gray-100"></div>
                                            <div class="py-1">
                                                <a href="{{ route('user.options') }}" class="dropdown-item">Réglages</a>
                                            </div>
                                            <div class="border-t border-gray-100"></div>
                                            <div class="py-1">
                                                <a href="{{ route('user.logout') }}" class="dropdown-item">Déconnexion</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="text-sm mr-4 text-gray-700">Se connecter</a>
                            <a href="{{ route('register') }}" class="btn btn-blue">S'inscrire</a>
                        @endguest
                    </div>

                </div>
            </div>
    </nav>
</div>

@if(request()->is('admin') || request()->is('admin/*'))
    <div class="bg-gray-100 dark:bg-gray-800 shadow px-5 py-3">
        <nav class="flex items-center justify-between flex-wrap w-11/12 m-auto">
            <div class="w-full block">
                <div class="text-sm overflow-x-auto overflow-y-hidden whitespace-no-wrap">
                    <a href="{{ route('admin.index') }}" class="navbar-items subcategory">{{ __('Administration') }}</a>
                </div>
            </div>
        </nav>
    </div>
@endif
