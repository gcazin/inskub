@extends('partials.account-content')

@section('account-content')
    <div class="py-3 px-4 bg-white dark:bg-gray-700 rounded-t">Modifier vos préférences, et aidez-nous à personnaliser votre expérience.</div>
    <div class="bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-b">
        <label class="custom-label flex justify-between">
            <span class="select-none w-11/12"> Changer le thème</span>
            <div class="text-right">
                <div class="bg-white dark:bg-gray-900 shadow w-6 h-6 p-1 flex border-blue-200 dark:border-black border-solid border">
                    <input type="checkbox" class="hidden" name="remember" id="themeSwitch" {{ old('remember') ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-blue-500 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                </div>
            </div>
        </label>
    </div>
@endsection
