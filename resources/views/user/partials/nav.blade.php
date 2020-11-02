@php
    use Illuminate\Support\Facades\Route;

    function checkRouteName($name) {
        return (Route::currentRouteName() == $name) ? 'active' : null;
    }
@endphp


