@php
    use Illuminate\Support\Facades\Route;

    function checkRouteName($name) {
        return (Route::currentRouteName() == $name) ? 'active' : null;
    }
@endphp

<div class=" overflow-x-auto">
    <nav class="nav nav-pills nav-fill mb-3">
        <a class="nav-item nav-link {{ checkRouteName('user.edit') }}" href="{{ route('user.edit') }}">Modifier le profil</a>
        <a class="nav-item nav-link {{ checkRouteName('user.options') }}" href="{{ route('user.options') }}">Options</a>
    </nav>

</div>
