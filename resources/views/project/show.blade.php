@extends('layouts.base', ['full' => true])

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    @if($project->finish === 1)
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    @endif
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
    <style>
        .primary-color, ul.stepper li.active a .circle, ul.stepper li.completed a .circle {
            background-color: #4285f4 !important;
        }
        ul.stepper {
            overflow-x: hidden;
            overflow-y: auto;
            counter-reset: section;
            margin: 0;
            padding: 0;
        }

        ul.stepper li a {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            text-align: center;
            text-decoration: none;
        }

        ul.stepper li a .circle {
            width: 1.75rem;
            height: 1.75rem;
            line-height: 1.7rem;
            color: #fff;
            text-align: center;
            background: rgba(0,0,0,0.38);
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }

        ul.stepper li a .label {
            display: inline-block;
            color: rgba(0,0,0,0.38)
        }

        ul.stepper li.active a .label,ul.stepper li.completed a .label {
            font-weight: 600;
            color: rgba(0,0,0,0.87)
        }

        .stepper-horizontal {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .stepper-horizontal li {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-transition: .5s;
            transition: .5s
        }

        .stepper-horizontal li a .label {
            margin-top: .63rem
        }

        .stepper-horizontal li:not(:last-child):after {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            height: 1px;
            margin: .5rem 0 0 0;
            content: "";
            background-color: rgba(0,0,0,0.1)
        }

        .stepper-horizontal li:not(:first-child):before {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            height: 1px;
            margin: .5rem 0 0 0;
            content: "";
            background-color: rgba(0,0,0,0.1)
        }

        @media(max-width: 47.9375rem) {
            .stepper-horizontal {
                -webkit-box-orient:vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column
            }

            .stepper-horizontal li {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-align: start;
                -ms-flex-align: start;
                align-items: flex-start
            }

            .stepper-horizontal li a .label {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-flow: column nowrap;
                flex-flow: column nowrap;
                -webkit-box-ordinal-group: 3;
                -ms-flex-order: 2;
                order: 2;
                margin-top: .2rem
            }

            .stepper-horizontal li:not(:last-child):after {
                position: absolute;
                top: 3.75rem;
                left: 2.19rem;
                width: 1px;
                height: calc(100% - 40px);
                content: ""
            }
        }

        .stepper-horizontal>li:not(:last-of-type) {
            margin-bottom: 0 !important
        }

        .stepper-vertical {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between
        }

        .stepper-vertical li {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start
        }

        .stepper-vertical li a {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-item-align: start;
            align-self: flex-start
        }

        .stepper-vertical li a .circle {
            -webkit-box-ordinal-group: 2;
            -ms-flex-order: 1;
            order: 1
        }

        .stepper-vertical li a .label {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-flow: column nowrap;
            flex-flow: column nowrap;
            -webkit-box-ordinal-group: 3;
            -ms-flex-order: 2;
            order: 2;
            margin-top: .2rem
        }

        .stepper-vertical li.completed a .label {
            font-weight: 500
        }

        .stepper-vertical li .step-content {
            display: block;
            padding: .94rem;
            margin-top: 0;
            margin-left: 3.13rem
        }

        .stepper-vertical li .step-content p {
            font-size: .88rem
        }

        .stepper-vertical li:not(:last-child):after {
            position: absolute;
            top: 3.44rem;
            left: 2.19rem;
            width: 1px;
            height: calc(100% - 40px);
            content: "";
            background-color: rgba(0,0,0,0.1)
        }

        .spin {
            -webkit-animation:spin 4s linear infinite;
            -moz-animation:spin 4s linear infinite;
            animation:spin 4s linear infinite;
        }
        @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
        @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
        @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
    </style>
@endsection

@section('title')
    Projet "{{ $project->title }}"
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

        <!-- Stepper de l'expertise -->
        @if($project->type === 1)
            <x-section class="mb-3">
                <div class="steps">
                    <!-- Horizontal Steppers -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Stepers Wrapper -->
                            <ul class="stepper stepper-horizontal">

                                <!-- First Step -->
                                <li class="completed">
                                    <a href="#!">
                                        <span class="circle"><ion-icon class="align-text-top h5" name="checkmark-outline"></ion-icon></span>
                                        <span class="label">Demande d'expertise</span>
                                    </a>
                                </li>

                                <!-- Second Step -->
                                <li class="{{ $project->finish === 1 ? 'completed' : 'active' }}">
                                    <a href="#!">
                                        <span class="circle">{!! $project->finish === 1 ? '<ion-icon class="align-text-top h5" name="checkmark-outline"></ion-icon>' : '<ion-icon class="spin align-text-top h5" name="sync-outline"></ion-icon>' !!}</span>
                                        <span class="label">Expertise en cours</span>
                                    </a>
                                </li>

                                <!-- Third Step -->
                                <li class="{{ $project->finish === 1 ? 'completed' : 'warning' }}">
                                    <a href="#!">
                                        <span class="circle"><ion-icon class="align-text-top h5" name="checkmark-outline"></ion-icon></span>
                                        <span class="label">Expertise terminée</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- /.Stepers Wrapper -->

                        </div>
                    </div>
                </div>
            </x-section>
        @endif

        @if($project->type === 1 && $project->finish === 1 && $project->user_id !== auth()->id())
            <x-section>
                <div class="">
                    <div class="text-center">
                        <h4>Donner un avis sur l'expert</h4>
                    </div>
                    @if(\App\Rating::where('expert_id', '=', $project->user_id)->where('rated_by', '=', auth()->id())->count() === 0)
                        <x-form :action="route('expert.ratingExpert', $project->user_id)">
                            <input id="rating" name="rating" class="kv-ltr-theme-svg-star rating-loading" value="1" dir="ltr" data-size="md">
                            <x-input label="Description (optionnel)" name="description" placeholder="Expertise..."></x-input>
                            <x-submit>Valider</x-submit>
                        </x-form>
                    @else
                        <div class="mt-3">
                            <x-alert type="success">Vous avez déjà donné une note à cette expert</x-alert>
                        </div>
                    @endif
                </div>
            </x-section>
        @elseif($project->type === 1 && $project->finish === 1 && $project->user_id === auth()->id())
            <div class="mt-3">
                <x-alert type="success">Expertise terminée</x-alert>
            </div>
        @else
            <x-submit-post :action="route('project.postStore', $project->id)"></x-submit-post>

            <x-post-list :model="$posts"></x-post-list>
        @endif
    </x-container>

    <x-right-sidebar>
        <div class="d-flex flex-column overflow-hidden">
            <div class="row no-gutters mb-3">
                <div class="col">
                    <p class="text-uppercase text-secondary">Calendrier</p>
                </div>
                <div class="col text-right" style="font-size: 0.875rem">{{ $project->daysLeft($project) }}</div>
            </div>
            <div id="calendar" class="mb-3" style="height: 200px"></div>

            <h6 class="title__section text-uppercase text-secondary mb-3">Participants</h6>
            @foreach($project->users as $participant)
                <div class="row menu-item position-relative">
                    <div class="col-2 px-0">
                        <img class="rounded-circle" style="height: 2rem" src="{{ \App\User::getAvatar($participant->id) }}" alt="">
                    </div>
                    <div class="col-8">
                        <span class="mr-auto font-weight-bold">{{ $participant->user->first_name }} {{ $participant->user->last_name }}</span>
                    </div>
                    <div class="col-1">
                        <span class="d-inline-block bg-success rounded-circle" style="height: 5px; width: 5px"></span>
                    </div>
                    <a class="position-absolute h-100 w-100" href="{{ route('chat.createConversation', $participant->id) }}"></a>
                </div>
            @endforeach

            @if($project->type === 1 && $project->finish === 0)
                <h6 class="title__section text-uppercase text-secondary mb-3">Actions</h6>
                <x-form :action="route('expert.finishExpertise', $project->id)">
                    <button type="submit" class="btn btn-danger btn-block">Finir l'expertise</button>
                </x-form>
            @endif
        </div>
    </x-right-sidebar>

    <!-- Modal de création d'une tâche -->
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
    @if($project->finish === 1)
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/fr.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.js"></script>
        <script>
            $(document).ready(function(){
                $('.kv-ltr-theme-svg-star').rating({
                    hoverOnClear: false,
                    theme: 'krajee-svg',
                    language: 'fr'
                });
            });
        </script>
    @endif

    <!-- Preview d'une image -->
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

    <!-- Calendrier -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'frLocale',
                header: false,
                plugins: [ 'dayGrid', 'bootstrap' ],
                height: 400,
                eventColor: '#4299e1',
                eventTextColor: 'white',
                themeSystem: 'bootstrap',
                fixedWeekCount: false,
                titleFormat: {
                    weekDay: 'narrow'
                },
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
