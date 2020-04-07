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
                        <a class="mr-4 text-gray-600 text-2xl border-solid border-gray-200 hover:text-blue-500" href="{{ route('chat.index') }}"><i class="far fa-bell"></i></a>
                        <a class="mr-4 relative text-gray-600 text-2xl border-solid border-gray-200 hover:text-blue-500" href="{{ route('chat.index') }}">
                            <i class="far fa-comment-dots"></i>
                        </a>
                        @if(auth()->user()->role_id === 2) <!-- Salarié -->
                        <a class="pr-3 mx-4 btn btn-blue" href="{{ route('show.formation') }}">Trouver une formation</a>
                        @elseif(auth()->user()->role_id === 3) <!-- Entreprise -->
                        <a class="pr-3 mx-4 btn btn-blue" href="{{ route('article.create') }}">Proposer une offre</a>
                        @elseif(auth()->user()->role_id === 4) <!-- Ecole -->
                        <a class="pr-3 mx-4 btn btn-blue" href="{{ route('create.formation') }}">Proposer une formation</a>
                        @elseif(auth()->user()->role_id === 5) <!-- Etudiant -->
                        <a class="pr-3 mx-4 btn btn-blue" href="{{ route('article.create') }}">Boite à idées</a>
                        @endif
                        <div class="relative text-sm">

                            <!-- Mon compte -->
                            <button id="userButton" class="flex items-center focus:outline-none text-gray-600 hover:text-blue-500">
                                <img class="w-10 h-10 rounded-full" src="{{ \App\User::getAvatar(auth()->user()->id) }}" alt="Avatar of User">
                            </button>

                            <!-- Dropdown -->
                            <div id="userMenu" class="bg-white border border-blue-100 dark:border-gray-800 border-solid dark:bg-gray-700 rounded shadow-md mt-5 absolute pin-t pin-r min-w-full overflow-auto z-30 invisible shadow" style="right: 30%; width: 180px">
                                <ul class="list-reset font-normal">
                                    <li><a href="{{ route('user.edit', auth()->id()) }}" class="px-4 py-3 block text-black dark:text-gray-300 hover:text-blue-500 dark-hover:bg-gray-800 no-underline hover:no-underline transition-100">Mon compte</a></li>
                                    <li><a href="{{ route('user.options') }}" class="px-4 py-3 block text-black dark:text-gray-300 hover:text-blue-500 dark-hover:bg-gray-800 no-underline hover:no-underline transition-100">Réglages</a></li>
                                    @if(auth()->user()->role_id === 1)
                                        <li><a href="{{ route('admin.index') }}" class="px-4 py-3 block text-black dark:text-gray-300 hover:text-blue-500 dark-hover:bg-gray-800 no-underline hover:no-underline transition-100">Administration</a></li>
                                    @endif
                                    <li><hr class="border-t mx-2 border-gray-200 dark:border-gray-600"></li>
                                    <li><a href="{{ route('user.logout') }}" class="px-4 py-3 block text-black hover:text-red-500 dark-hover:bg-gray-800 no-underline hover:no-underline transition-100">Déconnexion</a></li>
                                </ul>
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
