@extends('layouts.base')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
    <style>
        .fc .fc-row .fc-content-skeleton td.alert.alert-info {
            background: 0 0 !important;
        }
        td.fc-today.alert.alert-info {
            background: #4299e11a !important;
            color: #4299e1;
        }
    </style>
@endsection

@section('content')

    <x-container>

        <x-section class="mb-4">
            <div id="calendar"></div>
        </x-section>

        <x-section>
            <div class="row">
                <div class="col">
                    <h3 class="mb-3">Tâches</h3>
                </div>
                <div class="col h5 text-muted text-center">
                    {{ count(\App\Todo::where('project_id', $project->id)->get()) }} tâches
                </div>
                <div class="col text-right">
                    <button type="button" class="btn" data-toggle="modal" data-target=".new-todo">
                        <ion-icon class="h2 text-primary" name="add-outline"></ion-icon>
                    </button>
                </div>
            </div>
            @forelse(\App\Todo::where('project_id', $project->id)->get() as $todo)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2 h5 pb-3 border-right text-center">
                            {{ \Carbon\Carbon::parse($todo->deadline)->day }}
                            <p class="text-muted">{{ \Carbon\Carbon::parse($todo->deadline)->monthName }}</p>
                        </div>
                        <div class="col-10 pb-3 pl-4 position-relative">
                            <div class=" h5 bg-white border p-3 rounded">
                                <p class="h5">{{ $todo->title }}</p>
                                <p class="text-muted">{{ $todo->description }}</p>
                                <small class="text-muted">
                                    <ion-icon class="align-text-bottom" name="person-outline"></ion-icon>
                                    Assigné à
                                    <img
                                        src="{{ \App\User::getAvatar($todo->assigned_to) }}"
                                        class="rounded-circle ml-1" style="height: 20px;width: 20px"
                                        alt="">
                                    {{ App\User::find($todo->assigned_to)->first_name }} {{ \App\User::find($todo->assigned_to)->last_name }}
                                </small>
                            </div>
                            <div class="position-absolute bg-transparent rounded-circle" style="height: 15px; width: 15px; left: -7px; top: 5px; border: 5px solid #4299e1"></div>
                        </div>
                    </div>
                </div>
            @empty
                <x-alert type="warning">Aucune tâche n'a encore été ajouté</x-alert>
            @endforelse
        </x-section>

        <x-modal title="Création d'une nouvelle tâche" name="new-todo">
            <x-form :action="route('project.todo.create', $project->id)">
                <x-input label="Titre" name="title" placeholder="Mon super titre"></x-input>
                <x-textarea label="Description" name="description"></x-textarea>

                <div class="form-group">
                    <label for="assigned_to">Assigné à</label>
                    <select name="assigned_to" class="form-control" id="assigned_to">
                        @foreach($project->users as $participant)
                            <option value="{{ $participant->user_id }}">
                                {{ \App\User::find($participant->user_id)->first_name }} {{ \App\User::find($participant->user_id)->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="deadline">Date de fin</label>
                    <input type="text" class="form-control" id="deadline" name="deadline" data-toggle="datepicker" autocomplete="off">
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <x-submit>Créer une nouvelle tâche</x-submit>
            </x-form>
        </x-modal>

    </x-container>

    <x-right-sidebar>
        <div class="row no-gutters">
            <div class="col">
                <h6 class="title__section text-uppercase text-secondary">Vos notes</h6>
            </div>
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target=".new-note"><ion-icon class="h4" name="add-outline"></ion-icon></a>
            </div>

        </div>

        <div class="row">
            <div class="col">
                @forelse(\App\Note::where('project_id', $project->id)->orderByDesc('created_at')->get() as $note)
                    <div class="card mb-3 position-relative">
                        <div class="card-header bg-white pb-0">
                            <p class="font-weight-bold">{{ $note->title }}</p>
                        </div>
                        <div class="card-body pb-0">
                            <p>{{ $note->description }}</p>
                        </div>
                    </div>
                    <a href="{{ route('project.note.show', ['id' => $project->id, 'note_id' => $note->id]) }}" class="position-absolute h-100 w-100" style="left: 0; top: 0"></a>
                @empty
                    <x-alert type="info">
                        Aucun élément à afficher ici
                    </x-alert>
                @endforelse
            </div>
        </div>
    </x-right-sidebar>

    <x-modal title="Création d'une nouvelle note" name="new-note" submit="Créer le projet">
        <x-form :action="route('project.note.create', $project->id)">
            <x-input label="Titre" name="title" placeholder="Ma super note" required></x-input>
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <x-textarea label="Description" name="description" rows="3"></x-textarea>

            <x-submit>Créer la note</x-submit>
        </x-form>
    </x-modal>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.fr-FR.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
                language: 'fr-FR',
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#search-project").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#project-list li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'frLocale',
                buttonText: {
                    today: "Aujourd'hui",
                    prev: '<',
                    next: '>',
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                },
                plugins: [ 'dayGrid', 'bootstrap' ],
                height: 500,
                eventColor: '#4299e1',
                eventTextColor: 'white',
                themeSystem: 'bootstrap',
                fixedWeekCount: false,
                events: [
                        <?php foreach(\App\Todo::where('project_id', $project->id)->get() as $todo): ?>
                    {
                        id: '{{ $todo->id }}',
                        title: '{{ $todo->title }}',
                        start: '{{ $todo->deadline }}',
                    },
                    <?php endforeach; ?>

                ]
            });

            calendar.render();
        });

    </script>
@endsection
