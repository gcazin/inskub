@extends('layouts.base', ['full' => true])

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
        .fc-left {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <x-container>

        <x-section class="mb-3">
            <div class="row mb-3">
                <div class="col">
                    <h4 class="">Projet <span class="text-primary">{{ $project->title }}</span></h4>
                </div>
                <div class="col text-right">
                    A rendre {{ \Carbon\Carbon::parse($project->deadline)->diffForHumans() }}
                </div>
            </div>
            <p class="text-muted h5">{{ $project->description }}</p>
        </x-section>

        <x-submit-post :action="route('project.postStore', $project->id)"></x-submit-post>
        <x-post-list :model="$posts"></x-post-list>

    </x-container>

    <x-right-sidebar>
        <div class="d-flex flex-column overflow-hidden">
            <div id="calendar"></div>
        </div>
    </x-right-sidebar>

    <div class="modal fade new-todo" tabindex="-1" role="dialog" aria-labelledby="new-todo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Création d'une nouvelle note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <x-form :action="route('project.note.create', $project->id)">
                        <div class="modal-body">
                            <x-input label="Titre" name="title" placeholder="Ma super note" required></x-input>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <x-textarea label="Description" name="description" rows="3" required></x-textarea>

                            <div class="modal-footer">
                                <div class="container-fluid px-0">
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-light btn-block" data-dismiss="modal">Fermer</button>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary btn-block">Créer la note</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let shareButton = document.querySelector('.share-button');

        shareButton.addEventListener('click', () => {
            if (navigator.share) {
                navigator.share({
                    title: 'WebShare API Demo',
                    url: 'https://codepen.io/ayoisaiah/pen/YbNazJ'
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
                    .catch(console.error);
            } else {
                console.log('Votre navigateur ne supporte pas ça')
                //shareDialog.classList.add('is-open');
            }
        });
    </script>
    <script>
        function displayPreview(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').removeClass('d-none')
                    $('#img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img-input").change(function(){
            displayPreview(this);
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
                plugins: [ 'dayGrid', 'bootstrap' ],
                height: 500,
                eventColor: '#4299e1',
                eventTextColor: 'white',
                themeSystem: 'bootstrap',
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
