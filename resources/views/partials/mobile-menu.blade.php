<div id="mobile-menu" class="fixed-bottom d-lg-none text-center bg-white py-3 px-3 border-top border-gray">
    <div class="row no-gutters">
        <div class="col">
            <a href="{{ route('index') }}" class="{{ (request()->is('/')) ? 'text-primary' : 'text-dark ' }}">
                <ion-icon class="h4 m-0" name="home-outline"></ion-icon>
                <span class="d-block text-muted" style="font-size: .750rem;">Accueil</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('project.index') }}" class="{{ (request()->is('projects')) ? 'text-primary' : 'text-dark ' }}">
                <ion-icon class="h4 m-0" name="list-outline"></ion-icon>
                <span class="d-block text-muted" style="font-size: .750rem;">Projet</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('discover') }}" class="{{ (request()->is('discover')) ? 'text-primary' : 'text-dark ' }}">
                <ion-icon class="h4 m-0" name="apps-outline"></ion-icon>
                <span class="d-block text-muted" style="font-size: .750rem;">Découvrir</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('expert.search') }}" class="{{ (request()->is('expert*')) ? 'text-primary' : 'text-dark ' }}">
                <ion-icon class="h4 align-top mr-1" name="people-outline"></ion-icon>
                <span class="d-block text-muted" style="font-size: .750rem;">Expert</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('chat.index') }}" class="{{ (request()->is('chat')) ? 'text-primary' : 'text-dark ' }}">
                <ion-icon class="h4 m-0" name="chatbubbles-outline"></ion-icon>
                <span class="d-block text-muted" style="font-size: .750rem;">Messagerie</span>
            </a>
        </div>
    </div>
</div>
