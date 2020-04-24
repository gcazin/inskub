@auth
    <div id="mobile-menu" class="nav-mobile lg:hidden fixed bottom-0 right-0 left-0 bg-white border-t-2 border-gray-400"
     style="height: 65px">
    <div class="w-11/12 mx-auto flex justify-between text-center text-gray-600">
        <a href="{{ route('post.index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <ion-icon class="text-2xl" name="home-outline"></ion-icon>
            <span class="text-sm block" style="font-size: 0.775rem">Accueil</span>
        </a>
            <a href="{{ route('discover') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <ion-icon class="text-2xl" name="grid-outline"></ion-icon>
                <span class="text-sm block" style="font-size: 0.775rem">Découvrir</span>
            </a>
            <a href="{{ route('post.create') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <ion-icon class="text-2xl" name="create-outline"></ion-icon>
                <span class="text-sm block" style="font-size: 0.775rem">Publier</span>
            </a>
            <a href="{{ route('chat.index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <ion-icon class="text-2xl" name="chatbubbles-outline"></ion-icon>
                <span class="text-sm block" style="font-size: 0.775rem">Messages</span>
            </a>
            <a href="{{ route('user.profile', auth()->id()) }}" class="px-2 py-2 flex-1 focus:text-blue-700">
                <ion-icon class="text-2xl" name="person-outline"></ion-icon>
                <span class="text-sm block" style="font-size: 0.775rem">Profil</span>
            </a>
    </div>
</div>
@endauth
