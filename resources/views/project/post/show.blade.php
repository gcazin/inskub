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
        .fc-left {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <x-single-post :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-single-post>

    <x-right-sidebar>
        <div class="d-flex flex-column overflow-hidden">
            <div class="row no-gutters mb-3">
                <div class="col">
                    <p class="text-uppercase text-secondary">Calendrier</p>
                </div>
                <div class="col text-right" style="font-size: 0.875rem">{{ \App\Project::find($post->project_id)->daysLeft(\App\Project::find($post->project_id)) }}</div>
            </div>
            <div id="calendar" class="mb-3" style="height: 200px"></div>

            <h6 class="title__section text-uppercase text-secondary mb-3">Participants</h6>
            @foreach(\App\Project::find($post->project_id)->users as $participant)
                <div class="row menu-item">
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
        </div>
    </x-right-sidebar>
@endsection

@section('script')
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
                        <?php foreach(\App\Todo::where('project_id', $post->project_id)->get() as $todo): ?>
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
