<div id="mobile-menu" class="fixed-bottom position-sticky mt-5 d-lg-none text-center bg-white py-3 px-3 border-top border-gray">
    <div class="row no-gutters">
        <div class="col">
            <a href="{{ route('index') }}">
                <ion-icon class="h4 m-0 icon-container-primary text-primary" name="home-outline"></ion-icon>
                <span class="d-block {{ (request()->is('index')) ? 'text-primary' : 'text-dark ' }}" style="font-size: .750rem;">Accueil</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('project.index') }}">
                <ion-icon class="h4 m-0 icon-container-primary text-primary" name="list-outline"></ion-icon>
                <span class="d-block {{ (request()->is('project*')) ? 'text-primary' : 'text-dark ' }}" style="font-size: .750rem;">Projet</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('discover.index') }}">
                <ion-icon class="h4 m-0 icon-container-primary text-primary" name="apps-outline"></ion-icon>
                <span class="d-block {{ (request()->is('discover')) ? 'text-primary' : 'text-dark ' }}" style="font-size: .750rem;">Découvrir</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('expert.index') }}">
                <ion-icon class="h4 align-top mr-1 icon-container-primary text-primary" name="people-outline"></ion-icon>
                <span class="d-block {{ (request()->is('expert*')) ? 'text-primary' : 'text-dark ' }}" style="font-size: .750rem;">Expert</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('chat.show') }}">
                <ion-icon class="h4 m-0 icon-container-primary text-primary" name="chatbubbles-outline"></ion-icon>
                <span class="d-block {{ (request()->is('chat')) ? 'text-primary' : 'text-dark ' }}" style="font-size: .750rem;">Messagerie</span>
            </a>
        </div>
    </div>
</div>
