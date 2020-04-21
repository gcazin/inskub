@extends('partials.account-content')

@section('account-content')
    <div class="py-3 px-4 bg-white dark:bg-gray-700 rounded-t">Modifier des éléments de votre compte ici.</div>
    <div class="bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-b">
        <div class="container">
            <div class="row">
                @if ($message = session()->get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Il y a quelques problèmes avec vos valeurs saisies<br><br>
                        <ul class="list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </div>
        <form action="{{ route('user.edit', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex w-full items-center justify-center bg-grey-lighter mt-2 mb-5">
                <img class="w-20 inline-block mr-3 rounded-full" src="{{ \App\User::getAvatar($user->id) }}">
                <label class="flex flex-col text-center btn btn-light tracking-wide border border-blue cursor-pointer text-blue-400 hover:text-blue-500">
                    <span class="mt-2 text-sm leading-normal">Changer votre avatar</span>
                    <input type="file" class="hidden" name="avatar" id="avatar" aria-describedby="fileHelp">
                </label>
            </div>
            <div class="form-group">
                <label for="name">Changer votre pseudo:</label>
                <input name="name" type="text" id="name" class="input" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Changer votre adresse mail:</label>
                <input name="email" type="email" id="email" class="input" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="email">Nouveau mot de passe:</label>
                <input name="password" type="password" id="password" class="input" autocomplete="false">
            </div>
            <div class="form-group">
                <label for="email">Confirmation du nouveau mot de passe:</label>
                <input name="password_confirmation" type="password" id="confirm_password" class="input">
            </div>
            <hr class="dark:border-gray-700">
            <div class="p-3 dark:bg-gray-800 text-right rounded-b">
                <button class="btn btn-green" type="submit">Sauvegarder</button>
            </div>
        </form>
    </div>
@endsection
