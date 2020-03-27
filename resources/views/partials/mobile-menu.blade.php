<div id="mobile-menu" class="nav-mobile lg:hidden fixed bottom-0 right-0 left-0 bg-white border-t-2 border-gray-300">
    <div class="w-11/12 mx-auto flex justify-between text-center text-gray-600">
        <a href="{{ route('index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <i class="fas fa-home"></i>
            <span class="text-sm block" style="font-size: 0.775rem">Accueil</span>
        </a>
        <a href="#" class="px-2 py-2 flex-1 focus:text-blue-700">
            <i class="fas fa-briefcase"></i>
            <span class="text-sm block" style="font-size: 0.775rem">Découvrir</span>
        </a>
        <a href="{{ route('create.post') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <i class="far fa-plus-square"></i>
            <span class="text-sm block" style="font-size: 0.775rem">Publier</span>
        </a>
        <a href="{{ route('chat.index') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <i class="far fa-comment"></i>
            <span class="text-sm block" style="font-size: 0.775rem">Messages</span>
        </a>
        <a href="{{ route('edit') }}" class="px-2 py-2 flex-1 focus:text-blue-700">
            <i class="far fa-user-circle"></i>
            <span class="text-sm block" style="font-size: 0.775rem">Profil</span>
        </a>
    </div>
</div>
