@php
    $conversations = \Musonza\Chat\Facades\ChatFacade::conversations()
                ->setPaginationParams(['sorting' => 'desc'])
                ->setParticipant(auth()->user())
                ->isPrivate()
                ->perPage(10)
                ->get();

    $unreadCount = \Musonza\Chat\Facades\ChatFacade::messages()->setParticipant(auth()->user())->unreadCount();
@endphp

<div class="position-sticky d-none d-lg-flex flex-column rounded-lg col-lg-2 mt-3 pl-3">
    <x-section>
        <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Menu</h6>
        <div class="d-flex flex-column pb-3">
            <a class="menu-item" href="{{ route('index') }}">
                <ion-icon class="h4 align-top mr-1" name="home-outline"></ion-icon> Accueil
            </a>
            <a class="menu-item {{ request()->is('projects') ? 'active' : null }}" href="{{ route('project.index') }}">
                <ion-icon class="h4 align-top mr-1" name="list-outline"></ion-icon> Projet
            </a>
            @if(auth()->user()->role_id === 2 || auth()->user()->role_id === 6)
                <a class="menu-item {{ request()->is('expert*') ? 'active' : null }}" href="{{ route('expert.search') }}">
                    <ion-icon class="h4 align-top mr-1" name="people-outline"></ion-icon> Expert
                </a>
            @endif
            <a class="menu-item" href="{{ route('discover') }}">
                <ion-icon class="h4 align-top mr-1" name="apps-outline"></ion-icon> Découvrir
            </a>
            <a class="menu-item" href="{{ route('chat.index') }}">
                <ion-icon class="h4 align-top mr-1" name="chatbubbles-outline"></ion-icon>
                Messagerie
                <span class="badge badge-pill badge-primary">{{ $unreadCount }}</span>
            </a>
            <a class="menu-item {{ request()->is('activity*') ? 'active' : null }}" href="{{ route('user.activity') }}">
                <ion-icon class="h4 align-top mr-1" name="bar-chart-outline"></ion-icon>
                Activité
            </a>
            @if(auth()->user()->role_id === 1)
                <div class="d-flex flex-column mt-3">
                    <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Projet</h6>
                    <a class="menu-item" href="{{ route('admin.index') }}">
                        <ion-icon class="h4 align-top mr-1" name="options-outline"></ion-icon> Administration
                    </a>
                </div>
            @endif
        </div>
        @if(request()->is('project/*'))
            <div class="d-flex flex-column pb-3">
                <h6 class="title__section text-uppercase text-secondary px-3 mb-3">Projet</h6>
                <a class="menu-item" href="{{ route('project.show', request()->id) }}">
                    <ion-icon class="h4 align-top mr-1" name="home-outline"></ion-icon> Accueil
                </a>
                <a class="menu-item" href="{{ route('project.todo.index', request()->id) }}">
                    <ion-icon class="h4 align-top mr-1" name="albums-outline"></ion-icon> Tâches
                </a>
            </div>
        @endif
    </x-section>
</div>
