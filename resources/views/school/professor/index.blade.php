<x-page title="Gestion des professeurs">
    <x-header>
        <x-slot name="title">Gestion des professeurs</x-slot>
        @include('school.partials.menu')
    </x-header>

    <x-container>
        <div class="row mb-3">
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-professor">
                    <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un professeur
                </button>
            </div>
            <x-element.modal title="Création d'un nouveau professeur" name="new-professor" size="">
                <x-form.item :action="route('school.professor.store')">
                    <x-form.input label="Nom de famille" name="last_name"></x-form.input>
                    <x-form.input label="Prénom" name="first_name"></x-form.input>
                    <x-form.input type="email" label="Adresse e-mail" name="email"></x-form.input>
                    <div class="form-group">
                        <label>Assigné à la classe</label>
                        @forelse($classrooms as $classroom)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="classroom_id-{{ $classroom->id }}" name="classrooms[]" class="custom-control-input" value="{{ $classroom->id }}">
                                <label class="custom-control-label" for="classroom_id-{{ $classroom->id }}">{{ $classroom->name }}</label>
                            </div>
                        @empty
                            <x-element.alert type="info">
                                <x-slot name="title">Vous devez au préalable avoir créer une ou plusieurs salle de classes.</x-slot>
                            </x-element.alert>
                        @endforelse
                    </div>

                    <x-form.submit>Créer le professeur</x-form.submit>
                </x-form.item>
            </x-element.modal>
        </div>

        <x-section>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th>Prénom</th>
                    <th>Adresse e-mail</th>
                    <th>Assigné à</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($professors as $professor)
                    <tr>
                        <td>{{ $professor->user->last_name }}</td>
                        <td>{{ $professor->user->first_name }}</td>
                        <td>{{ $professor->user->email }}</td>
                        <td>{{ $professor->classrooms->implode('name', ', ') }}</td>
                        <td>
                            <div class="col text-right">
                                <button type="button" class="btn" data-toggle="modal" data-target=".update-professor-{{ $professor->id }}">
                                    <ion-icon name="create-outline" class="text-success h4 mb-0"></ion-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-element.modal title="Mettre à jour le professeur {{ $professor->user->first_name }}" name="update-professor-{{ $professor->id }}" size="">
                        <x-form.item method="put" :action="route('school.professor.update', $professor->id)">
                            @foreach($classrooms as $classroom)
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        id="classroom-{{ $classroom->id }}-{{ $professor->id }}"
                                        name="classrooms[]"
                                        class="custom-control-input"
                                        value="{{ $classroom->id }}"
                                        {{ $professor->classrooms->contains('id', $classroom->id) ? 'checked' : null }}>
                                    <label class="custom-control-label" for="classroom-{{ $classroom->id }}-{{ $professor->id }}">{{ $classroom->name }}</label>
                                </div>
                            @endforeach
                            <x-form.submit>Mettre à jour</x-form.submit>
                        </x-form.item>
                    </x-element.modal>
                @endforeach
                </tbody>
            </table>

            {{ $professors->links() }}
        </x-section>
    </x-container>
</x-page>
