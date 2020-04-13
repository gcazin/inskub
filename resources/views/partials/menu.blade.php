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
                    <button id="userButton" class="flex items-center focus:outline-none text-gray-600 hover:text-blue-500">
                        <img class="w-10 h-10 rounded-full" src="{{ \App\User::getAvatar(auth()->user()->id) }}" alt="Avatar of User">
                    </button>
                </div>
            @endauth
            <div class="hidden lg:block flex items-center flex-shrink-0 text-black mr-6">
                <a href="{{ route('post.index') }}" class="pb-1 font-medium text-2xl tracking-tight text-gray-700 dark:text-gray-200"><img class="h-8 inline-block align-baseline" src="{{ asset('storage/images/logo.png') }}" class="h-8" alt="Logo"><span class="align-text-bottom">TomorrowInsurance</span></a>
            </div>
            <div id="main-nav" class="w-full text-xl font-medium hidden lg:inline flex-grow lg:flex lg:justify-end lg:w-auto">
            <!--<div class="text-base lg:flex-grow">
                <a href="{{ route('article.index') }}" class="navbar-items nav {{ routeName('post.index') }} dark:text-gray-400 dark-hover:text-gray-600 py-4">
                    Articles
                </a>
                <a href="{{ route('listing-agents') }}" class="navbar-items nav {{ routeName('threads') }} dark:text-gray-400 dark-hover:text-gray-600 py-4">
                    Agents généraux
                </a>
            </div>-->
                <div class="w-full lg:w-1/2 pr-0 mt-2 md:mt-0">
                    <div class="flex relative inline-block items-center justify-end sm:mt-3 lg:mt-0">
                        @auth
                            <a class="relative text-gray-600 border-solid border-gray-200 hover:text-blue-500" href="{{ route('chat.index') }}">
                                <ion-icon class="align-middle text-3xl" name="chatbox-outline"></ion-icon>
                            </a>
                            @if(auth()->user()->role_id === 1) <!-- Salarié -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('admin.index') }}">Administration</a>
                            @elseif(auth()->user()->role_id === 2) <!-- Salarié -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('show.formation') }}">Trouver une formation</a>
                            @elseif(auth()->user()->role_id === 3) <!-- Entreprise -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('article.create') }}">Proposer une offre</a>
                            @elseif(auth()->user()->role_id === 4) <!-- Ecole -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('create.formation') }}">Proposer une formation</a>
                            @elseif(auth()->user()->role_id === 5) <!-- Etudiant -->
                            <a class="pr-3 mx-4 btn btn-blue" href="{{ route('article.create') }}">Boite à idées</a>
                            @endif
                            <div class="relative text-sm">

                                <div x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button" class="transition ease-in-out duration-150">
                                            <img class="w-10 h-10 rounded-full" src="{{ \App\User::getAvatar(auth()->user()->id) }}" alt="Avatar of User">
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

@if(\Request::is('media') OR \Request::is('media/*'))
    <div class="bg-gray-100 dark:bg-gray-800 shadow px-5 py-3">
        <nav class="flex items-center justify-between flex-wrap w-11/12 m-auto">
            <div class="w-full block">
                <div class="text-sm overflow-x-auto overflow-y-hidden whitespace-no-wrap">
                    @php
                        $subcategories = \App\Subcategory::all();
                    @endphp
                    @foreach($subcategories as $subcategory)
                        <a href="{{ route('subcategory', $subcategory->id) }}" class="navbar-items subcategory">{{ $subcategory->title }}</a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
@endif

@if(\Request::is('admin') OR \Request::is('admin/*'))
    <div class="bg-gray-100 dark:bg-gray-800 shadow px-5 py-3">
        <nav class="flex items-center justify-between flex-wrap w-11/12 m-auto">
            <div class="w-full block">
                <div class="text-sm overflow-x-auto overflow-y-hidden whitespace-no-wrap">
                    <a href="{{ route('admin.index') }}" class="navbar-items subcategory">{{ __('Administration') }}</a>
                    <a href="{{ route('article.create') }}" class="navbar-items subcategory">{{ __('Créer un article') }}</a>
                    <a href="{{ route('admin.category.create') }}" class="navbar-items subcategory">{{ __('Créer une catégorie') }}</a>
                    <a href="{{ route('admin.subcategory.create') }}" class="navbar-items subcategory">{{ __('Créer une sous-catégorie') }}</a>
                </div>
            </div>
        </nav>
    </div>
@endif
