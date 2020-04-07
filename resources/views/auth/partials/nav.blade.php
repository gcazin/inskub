@php

use Illuminate\Support\Facades\Route;

function checkRouteName($name) {
    return (Route::currentRouteName() == $name) ? ("text-blue-500 border-b-2 border-blue-500") : null;
}

@endphp

<div class="mt-3 mb-5 overflow-x-auto">
    <nav class="flex flex-row lg:flex-col sm:flex-row">

        <a href="{{ route('user.profile', auth()->id()) }}" class="text-gray-600 py-4 px-2 lg:pr-6 block hover:text-blue-500 focus:outline-none font-medium whitespace-no-wrap">
            Votre profil
        </a>
        <a href="{{ route('user.edit') }}" class="text-gray-600 py-4 px-2 lg:pr-6 block hover:text-blue-500 focus:outline-none font-medium whitespace-no-wrap {{ checkRouteName('user.edit') }}">
            Modifier le profil
        </a>
        <a href="{{ route('user.options') }}" class="text-gray-600 py-4 px-2 lg:px-6 block hover:text-blue-500 focus:outline-none {{ checkRouteName('user.options') }} whitespace-no-wrap">
            Options
        </a>
        <!--<a href="{{ route('user.advanced') }}" class="text-gray-600 py-4 px-2 lg:px-6 block hover:text-blue-500 focus:outline-none {{ checkRouteName('user.advanced') }} whitespace-no-wrap">
            Avancés
        </a>-->
    </nav>
</div>
