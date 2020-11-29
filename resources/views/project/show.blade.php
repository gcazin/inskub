<x-page title='Projet "{{ $project->title }}"'>
    <x-slot name="head">
        <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css">
        <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
        <script src="https://kit.fontawesome.com/458ecbc1c5.js" crossorigin="anonymous"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />
        @if($project->finish === 1)
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css" />
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
    </x-slot>

    <x-header>
        <x-slot name="title">Projet {{ $project->title }}</x-slot>
        <x-slot name="subtitle">{{ $project->description }}</x-slot>
        <x-slot name="content">
            <x-post.submit :action="route('project.show', $project->id)"></x-post.submit>
        </x-slot>
    </x-header>

    <x-container>

        @if($project->type === 1 && $project->finish === 1 && $rating::isRated($project->user_id) === false)
            @role('intermediate')
            <div class="modal" id="rate-expert" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Expertise terminée</h5>
                        </div>
                        <div class="modal-body">
                            <p>Ci-dessous un aperçu du compte-rendu fourni par l'expert. Si vous êtes satisfait, vous devrez noter l'expert et ainsi bénéficier du rapport complet de l'expertise, au contraire, si il n'est pas conforme à vos attentes, vous pouvez faire une ré-évaluation de votre expertise.</p>

                            <div class="text-center">
                                <img src="{{ asset('storage/expertise/preview/'.$filename) }}" width="50%" alt="preview">
                            </div>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col"><span>Ce document est-il conforme à vos attentes ?</span></div>
                                    <div class="col text-right">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="check-doc" id="check-doc-yes">
                                            <label class="custom-control-label" for="check-doc-yes">Oui</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="check-doc" id="check-doc-no">
                                            <label class="custom-control-label" for="check-doc-no">Non</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="form-rating" class="mt-3">
                                <x-form.item :action="route('expert.rating', $project->user_id)">
                                    <div class="form-group">
                                        <input id="rating" name="rating" class="kv-ltr-theme-fas-star rating-loading" value="1" dir="ltr" data-size="md">
                                    </div>
                                    <x-form.input label="Description (optionnel)" name="description" placeholder="Expertise..."></x-form.input>
                                    <x-form.submit>Valider</x-form.submit>
                                </x-form.item>
                            </div>

                            <div id="form-renew" class="mt-3">
                                <x-form.item :action="route('expert.renew', $project->id)">
                                    <div class="text-center">
                                        <button onclick="confirm('Cette action est définitive, êtes-vous sûr?')" type="submit" class="btn btn-warning">Ré-évaluer l'expertise</button>
                                    </div>
                                </x-form.item>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        @endif

        <div class="row">

            <div class="col">
                <x-section>
                    <div class="accordion">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <span class="text-uppercase text-secondary">Calendrier</span>
                            </div>
                            <div class="col text-right" style="font-size: 0.875rem">
                                <button class="btn btn-link collapsed px-0" data-toggle="collapse" data-target="#showCalendar" aria-expanded="true" aria-controls="collapseOne">
                                    Afficher
                                </button>
                            </div>
                        </div>
                        <div class="show-calendar">
                            <div id="showCalendar" class="collapse" data-parent=".accordion">
                                <div id="calendar" class="mt-3" style="height: 200px"></div>
                            </div>
                        </div>
                    </div>
                </x-section>
            </div>

            <div class="col">
                <x-section>
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <span class="text-uppercase text-secondary">Tâches</span>
                        </div>
                        <div class="col text-right" style="font-size: 0.875rem">
                            <button class="btn btn-link collapsed px-0" data-toggle="collapse" data-target="#showTodos" aria-expanded="true" aria-controls="collapseThree">
                                Afficher
                            </button>
                        </div>
                    </div>

                    <div class="show-todos">
                        <div id="showTodos" class="collapse" data-parent=".show-todos">
                            @forelse(\App\Models\Todo::where('project_id', $project->id)->get() as $todo)
                                <div class="container-fluid mt-3 mx-0 px-0">
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
                                                        src="{{ \App\Models\User::getAvatar($todo->assigned_to) }}"
                                                        class="rounded-circle ml-1" style="height: 20px;width: 20px"
                                                        alt="">
                                                    {{ App\Models\User::find($todo->assigned_to)->first_name }} {{ \App\Models\User::find($todo->assigned_to)->last_name }}
                                                </small>
                                            </div>
                                            <div class="position-absolute bg-transparent rounded-circle" style="height: 15px; width: 15px; left: -7px; top: 5px; border: 5px solid #4299e1"></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <x-element.alert type="info">
                                    <x-slot name="title">
                                        Aucune tâche à afficher.
                                    </x-slot>
                                </x-element.alert>
                            @endforelse
                            <div class="text-right">
                                <x-element.button type="primary" name="new-todo">
                                    <x-slot name="props">
                                        data-toggle="modal" data-target=".new-todo"
                                    </x-slot>
                                    Ajouter une tâche
                                </x-element.button>
                            </div>
                        </div>
                    </div>
                </x-section>
            </div>

            @if($project->participants->count() > 0)
                <div class="col">
                    <x-section>
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <span class="text-uppercase text-secondary">Participants</span>
                            </div>
                            <div class="col text-right" style="font-size: 0.875rem">
                                <button class="btn btn-link collapsed px-0" data-toggle="collapse" data-target="#showParticipants" aria-expanded="true" aria-controls="collapseTwo">
                                    Afficher
                                </button>
                            </div>
                        </div>
                        <div class="show-participants">
                            <div id="showParticipants" class="collapse" data-parent=".show-participants">
                                @foreach($project->participants as $participant)
                                    <div class="row no-gutters align-items-center position-relative mt-3">
                                        <div class="col-2">
                                            <img class="rounded-lg" style="height: 2rem" src="{{ $participant::getAvatar($participant->id) }}" alt="">
                                        </div>
                                        <div class="col">
                                            <span class="mr-auto text-muted">{{ $participant->first_name }} {{ $participant->last_name }}</span>
                                        </div>
                                        <div class="col-1 text-right">
                                            <ion-icon name="radio-button-on-outline" class="text-success"></ion-icon>
                                        </div>
                                        <a class="position-absolute h-100 w-100" href="{{ route('chat.createConversation', $participant->id) }}"></a>
                                    </div>
                                @endforeach

                                @can('classroom.*')
                                    <div class="mt-3">
                                        <x-form.item method="put" :action="route('project.participants.update', $project->id)">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Mettre à jour les participants</button>
                                        </x-form.item>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </x-section>
                </div>
            @endif


            <div class="col">
                <x-section>
                    <div class="accordion">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <span class="text-uppercase text-secondary">Actions</span>
                            </div>
                            <div class="col text-right" style="font-size: 0.875rem">
                                <button class="btn btn-link collapsed px-0" data-toggle="collapse" data-target="#showActions" aria-expanded="true" aria-controls="collapseOne">
                                    Afficher
                                </button>
                            </div>
                        </div>
                        <div class="show-actions">
                            <div id="showActions" class="collapse" data-parent=".accordion">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-outline-primary btn-block" href="{{ route('chat.show', $conversation) }}">Conversation</a>
                                    </div>
                                    @role('expert')
                                    <div class="col">
                                        @if($project->type === 1 && $project->finish === 0)
                                            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target=".finish-expertise">
                                                Finir l'expertise
                                            </button>

                                            <x-element.modal title="Finir l'expertise" name="finish-expertise">
                                                <x-form.item :action="route('expert.finish', $project->id)" enctype>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" accept="application/pdf" name="media" id="media">
                                                        <label class="custom-file-label" for="media">Mettre en ligne le rapport d'expertise</label>
                                                    </div>
                                                    <hr>
                                                    <x-form.submit>Finir l'expertise</x-form.submit>
                                                </x-form.item>
                                            </x-element.modal>
                                        @endif
                                    </div>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </x-section>
            </div>
        </div>

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

                @if($rating::isRated($project->user_id))
                    <hr>
                    <div class="mt-3">
                        <p>Rapport d'expertise</p>
                        <a class="btn btn-primary" href="{{ asset('storage/' . \App\Models\ReportExpertise::where('project_id', $project->id)->first()->media) }}">Télécharger</a>
                    </div>
                @endif
            </x-section>
        @endif

        <x-element.modal title="Création d'une nouvelle tâche" name="new-todo">
            <x-form.item :action="route('project.todo.create', $project->id)">
                <x-form.input label="Titre" name="title" placeholder="Mon super titre"></x-form.input>
                <x-form.textarea label="Description" name="description"></x-form.textarea>

                <div class="form-group">
                    <label for="">Assigné à</label>
                    @foreach($project->participants as $participant)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="assigned_to" class="custom-control-input" id="customCheck1" value="{{ $participant->id }}">
                            <label class="custom-control-label" for="customCheck1">{{ $participant->first_name }} {{ $participant->last_name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="deadline">Date de fin</label>
                    <input type="text" class="form-control" id="deadline" name="deadline" data-toggle="datepicker" autocomplete="off">
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <hr>
                <x-form.submit>Créer une nouvelle tâche</x-form.submit>
            </x-form.item>
        </x-element.modal>

        @if($posts->count() > 0)
            <div class="row mb-4">
                <div class="col align-self-center">
                    <span class="text-muted" id="count"></span>
                </div>
                <div class="col text-right">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrer par
                        </button>
                        <div class="dropdown-menu filters" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('all')">Voir tout</a>
                            <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('images')">Images</a>
                            <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('documents')">Documents</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <x-post.list :model="$posts"></x-post.list>
    </x-container>

    <x-slot name="script">
        @if($project->finish === 1)
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/fr.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.js"></script>
            <script>
                $(document).ready(function(){
                    $('.kv-ltr-theme-fas-star').rating({
                        hoverOnClear: false,
                        theme: 'krajee-fas',
                        language: 'fr',
                        showClear: false,
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
                            <?php foreach(\App\Models\Todo::where('project_id', $project->id)->get() as $todo): ?>
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
            filterSelection("all")

            function filterSelection(c) {
                let x, i;

                let count = document.getElementById('count')

                x = document.getElementsByClassName("post");

                if (c === "all") c = "";
                // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
                for (i = 0; i < x.length; i++) {
                    //Element qui disparaissent
                    w3AddClass(x[i], "d-none");

                    //Elements qui doivent apparaitre
                    if (x[i].className.indexOf(c) > -1) w3RemoveClass(x[i], "d-none");
                }

                const divsArray = [].slice.call(x);
                //and all divs that are not display none
                const displayShow = divsArray.filter(function (el) {
                    return getComputedStyle(el).display !== "none"
                });

                count.innerText = displayShow.length + ' résultats affichés'
            }

            // Show filtered elements
            function w3AddClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    if (arr1.indexOf(arr2[i]) == -1) {
                        element.className += " " + arr2[i];
                    }
                }
            }

            // Hide elements that are not selected
            function w3RemoveClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    while (arr1.indexOf(arr2[i]) > -1) {
                        arr1.splice(arr1.indexOf(arr2[i]), 1);
                    }
                }
                element.className = arr1.join(" ");
            }

            // Add active class to the current control button (highlight it)
            var btnContainer = document.getElementById("filters");
            var btns = btnContainer.getElementsByClassName("dropdown-item");
            for (let i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    const current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                });
            }
        </script>

        <script>
            $(document).ready(function($){
                $("#btn-add").click(function (e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    let formData = {
                        content: $('#form-content').val(),
                        visibility_id: $('#visibility_id').val(),
                        project_id: $('#project_id').val(),
                    };

                    console.log(formData.content)
                    let state = $('#btn-add').val();
                    let type = "POST";
                    let ajaxurl = '/index';
                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        success: function (data) {
                            $('#post-list').prepend(data).fadeIn('slow')
                        },
                        error: function (data) {
                            console.log('Erreur : ' + data.response);
                        }
                    });
                });
            });
        </script>
        <script>
            $('#rate-expert').modal('show')
        </script>
        <script type="text/javascript">
            let check = $('input[name="check-doc"]')
            let formRating = $('#form-rating')
            let formRenew = $('#form-renew')

            $(formRating).hide()
            $(formRenew).hide()
            $(check).change(function() {
                if($('#check-doc-yes').is(':checked')) {
                    $(formRating).show()
                    $(formRenew).hide()
                } else if($('#check-doc-no').is(':checked')) {
                    $(formRenew).show()
                    $(formRating).hide()
                }
            })
        </script>
    </x-slot>
</x-page>
