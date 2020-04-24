@if(count($formations) > 0)
    @foreach($formations as $formation)
        <div class="formation flex py-4 border-b border-gray-400">
            <div class="w-full">
                <div class="flex justify-between">
                    <h1 class="font-bold overflow-hidden">
                        <a class="lg:text-xl font-bold text-blue-600 truncate" href="{{ route('formation.show', $formation->id) }}">
                            {{ $formation->title }}
                        </a>
                    </h1>
                </div>
                <div class="flex">
                    <p class="w-1/2 text-sm text-gray-600">
                        Publiée par
                        <img class="inline h-5 rounded-full" src="{{ \App\User::getAvatar($formation->user_id) }}" alt="">
                        {{ \App\User::find($formation->user_id)->last_name }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="flex items-center py-3">
        <div class="flex-1">
            <span class="text-gray-700 text-sm">Page {{ $formations->currentPage() }}</span>
        </div>
        <div class="flex-1">
            {{ $formations->links() }}
        </div>
    </div>
@else
    <div class="pt-2 pb-1">
        <div class="alert alert-info">
            Aucun résultat à afficher.
        </div>
    </div>
@endif
