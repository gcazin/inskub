<x-page title="Gestion des élèves">
    <x-header>
        <x-slot name="title">Gestion des élèves</x-slot>
        @include('school.partials.menu')
    </x-header>

    <x-container>
        <div class="row mb-3">
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-student">
                    <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer un élève
                </button>
            </div>
            <x-element.modal title="Création d'un nouveau éléve" name="new-student" size="">
                <x-form.item :action="route('school.student.store')">
                    <x-form.input label="Nom de famille" name="last_name"></x-form.input>
                    <x-form.input label="Prénom" name="first_name"></x-form.input>
                    <x-form.input type="email" label="Adresse e-mail" name="email"></x-form.input>
                    <div class="form-group">
                        <label>Assigné à la classe</label>
                        @forelse($classrooms as $classroom)
                            <div class="custom-control custom-radio">
                                <input type="radio" id="classroom_id-{{ $classroom->id }}" name="classroom_id" class="custom-control-input" value="{{ $classroom->id }}">
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
            <div class="row">
                @foreach($studentsClassroom as $id => $studentClassroom)
                    <div class="col-lg-4 col">
                        <p class="h5">
                            <span class="badge badge-primary">
                                {{ \App\Models\Classroom::find($id)->name }} </span> |
                            <span class="badge badge-secondary">
                                {{ $studentClassroom->count() }}
                                {{ \Illuminate\Support\Str::plural('élève', $studentClassroom->count()) }}
                            </span>
                        </p>
                        <table class="table table-striped table-hover mb-4">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse e-mail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($studentClassroom->sortBy('id') as $student)
                                <tr>
                                    <td>{{ $student->user->id }}</td>
                                    <td>{{ $student->user->last_name }}</td>
                                    <td>{{ $student->user->first_name }}</td>
                                    <td>{{ $student->user->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </x-section>
    </x-container>
</x-page>
