<x-page title="Gestion des classes">
    <x-header>
        <x-slot name="title">Gestion des classes</x-slot>
        @include('school.partials.menu')
    </x-header>

    <x-container>
        <div class="row mb-3">
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-classroom">
                    <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer une salle de classe
                </button>
            </div>
            <x-element.modal title="Création d'une nouvelle classe" name="new-classroom" size="">
                <x-form.item :action="route('school.classroom.store')">
                    <x-form.input label="Nom de la classe" name="name" required></x-form.input>
                    <x-form.textarea label="Description" name="description"></x-form.textarea>

                    <x-form.submit>Créer la salle de classe</x-form.submit>
                </x-form.item>
            </x-element.modal>
        </div>

        <x-section>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->description ?? 'Aucune description' }}</td>
                        <td>
                            <div class="col text-right">
                                <button type="button" class="btn" data-toggle="modal" data-target=".update-classroom-{{ $classroom->id }}">
                                    <ion-icon name="create-outline" class="text-success h4 mb-0"></ion-icon>
                                </button>
                            </div>
                            <x-element.modal title="Mettre à jour la classe" name="update-classroom-{{ $classroom->id }}" size="">
                                <x-form.item method="put" :action="route('school.classroom.update', $classroom->id)">
                                    <x-form.input label="Nom de la classe" name="name" value="{{ $classroom->name }}"></x-form.input>
                                    <x-form.textarea rows="4" label="Description" name="description">
                                        {{ $classroom->description }}
                                    </x-form.textarea>

                                    <x-form.submit>Mettre à jour</x-form.submit>
                                </x-form.item>
                            </x-element.modal>
                        </td>
                    </tr>
                    @empty
                    <x-element.alert type="info">
                        <x-slot name="title">Vous n'avez aucune salle de classe référencée.</x-slot>
                    </x-element.alert>
                @endforelse
                </tbody>
            </table>

            {{ $classrooms->links() }}
        </x-section>
    </x-container>
</x-page>
