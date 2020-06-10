<div class="fixed-bottom d-flex d-lg-none justify-content-around text-center fixed-bottom bg-white py-3 px-4 border-top border-gray">
    <a href="{{ route('index') }}" class="{{ (request()->is('/')) ? 'text-primary' : 'text-dark ' }}">
        <ion-icon class="h4 m-0" name="home-outline"></ion-icon>
        <span class="d-block" style="font-size: .8rem;">Accueil</span>
    </a>
    <a href="{{ route('project.index') }}" class="{{ (request()->is('projects')) ? 'text-primary' : 'text-dark ' }}">
        <ion-icon class="h4 m-0" name="list-outline"></ion-icon>
        <span class="d-block" style="font-size: .8rem;">Projet</span>
    </a>
    <a href="{{ route('discover') }}" class="{{ (request()->is('discover')) ? 'text-primary' : 'text-dark ' }}">
        <ion-icon class="h4 m-0" name="apps-outline"></ion-icon>
        <span class="d-block" style="font-size: .8rem;">Découvrir</span>
    </a>
    <a href="{{ route('chat.index') }}" class="{{ (request()->is('chat')) ? 'text-primary' : 'text-dark ' }}">
        <ion-icon class="h4 m-0" name="chatbubbles-outline"></ion-icon>
        <span class="d-block" style="font-size: .8rem;">Messagerie</span>
    </a>
    <a href="" class="{{ (request()->is('notifications')) ? 'text-primary' : 'text-dark ' }}">
        <ion-icon class="h4 m-0" name="notifications-outline"></ion-icon>
        <span class="d-block" style="font-size: .8rem;">Notification</span>
    </a>
</div>
