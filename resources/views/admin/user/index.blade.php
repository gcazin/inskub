@extends('admin.layouts.admin')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h2>Gestion des utilisateurs</h2>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-user">
                <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un utilisateur
            </button>
        </div>

        <x-modal title="Création d'un nouveau utilisateur" name="new-user" size="">
            <x-form :action="route('admin.user.store')">
                <div class="form-group">
                    <label for="role_id">Rôle</label>
                    <select name="role_id" class="form-control" id="role_id">
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input label="Nom de famille" name="last_name"></x-input>
                <x-input label="Prénom" name="first_name"></x-input>
                <x-input label="Adresse e-mail" name="email"></x-input>
                <x-input type="password" label="Mot de passe" name="password" :value="\Illuminate\Support\Str::random(8)"></x-input>

                <x-submit>Créer le projet</x-submit>
            </x-form>
        </x-modal>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Rôle</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Adresse e-mail</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ \App\Role::find($user->role_id)->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
