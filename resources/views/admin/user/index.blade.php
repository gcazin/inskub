<x-page>
    <x-header>
        <x-slot name="title">Administration</x-slot>
        @include('admin.partials.menu')
    </x-header>

    <x-container>
        <x-section>
            <div class="row mb-3">
                <div class="col">
                    <h2>Gestion des utilisateurs</h2>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-user">
                        <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un utilisateur
                    </button>
                </div>

                <x-element.modal title="Création d'un nouveau utilisateur" name="new-user" size="">
                    <x-form.item :action="route('admin.user.store')">
                        <div class="form-group">
                            <label for="role_name">Rôle</label>
                            <select name="role_name" class="form-control" id="role_name">
                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-form.input label="Nom de famille" name="last_name"></x-form.input>
                        <x-form.input label="Prénom" name="first_name"></x-form.input>
                        <x-form.input label="Adresse e-mail" name="email"></x-form.input>
                        <x-form.input type="password" label="Mot de passe" name="password"></x-form.input>
                        <x-form.input type="password" name="password_confirmation" label="Confirmation du mot de passe" placeholder="Confirmation du mot de passe"></x-form.input>
                        <div class="form-group">
                            <label for="department_id">Département (Nullable)</label>
                            <select class="departments form-control d-block" id="department_id" name="department_id">
                                <option value="">Choix du département</option>
                                @foreach(\App\Models\Department::all()->sortBy('code') as $department)
                                    <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_id">Compagnie (Nullable)</label>
                            <select class="companies form-control d-block" id="company_id" name="company_id">
                                <option value="">Choix de la compagnie</option>
                                @foreach(\App\Models\Company::all()->sortBy('name') as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-form.submit>Créer l'utilisateur</x-form.submit>
                    </x-form.item>
                </x-element.modal>
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
                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </x-section>
    </x-container>
</x-page>
