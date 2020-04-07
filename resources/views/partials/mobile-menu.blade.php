<div id="mobile-menu" class="nav-mobile lg:hidden fixed bottom-0 right-0 left-0 bg-white border-t-2 border-gray-300" style="height: 60px">
    <div class="w-11/12 mx-auto flex justify-between text-center text-gray-600">
        <a href="{{ route('post.index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <ion-icon class="text-lg" name="home-outline"></ion-icon>
            <span class="text-sm block" style="font-size: 0.775rem">Accueil</span>
        </a>
        <a href="{{ route('discover') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <ion-icon class="text-lg" name="grid-outline"></ion-icon>
            <span class="text-sm block" style="font-size: 0.775rem">Découvrir</span>
        </a>
        <a href="{{ route('post.create') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <ion-icon class="text-lg" name="create-outline"></ion-icon>
            <span class="text-sm block" style="font-size: 0.775rem">Publier</span>
        </a>
        <a href="{{ route('chat.index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <ion-icon class="text-lg" name="chatbubbles-outline"></ion-icon>
            <span class="text-sm block" style="font-size: 0.775rem">Messages</span>
        </a>
        @auth
            <a href="{{ route('user.profile', auth()->id()) }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <i class="far fa-user-circle"></i>
                <span class="text-sm block" style="font-size: 0.775rem">Profil</span>
            </a>
        @elseauth
            <a href="{{ route('login') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <ion-icon class="text-lg" name="person-outline"></ion-icon>
                <span class="text-sm block" style="font-size: 0.775rem">Compte</span>
            </a>
        @endauth
    </div>
</div>
