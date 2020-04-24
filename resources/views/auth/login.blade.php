@extends('layouts.base', ['title' => 'Connexion', 'full_width' => false])

@section('content')
    <div class="container lg:w-5/12">
        <h1 class="text-2xl text-gray-600 mb-3">Connexion</h1>
        <div class="card flex flex-col lg:flex-row">
            <div class="flex-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email">{{ __('Adresse mail') }}</label>
                        <input name="email" id="email" type="email" placeholder="email@domaine.fr" required>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Mot de passe') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password">
                    </div>

                    <div class="flex justify-content-between mb-3">
                        <div class="flex-1">
                            <label class="custom-label flex">
                                <div class="bg-white border-2 border-solid border-gray-300 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                                    <input type="checkbox" class="hidden" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <svg class="hidden w-4 h-4 text-blue-500 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                                </div>
                                <span class="select-none"> Se souvenir de moi</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-blue btn-block">
                            {{ __('Connexion') }}
                        </button>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
