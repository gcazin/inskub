@forelse(\App\UserExperience::all()->where('user_id', @request()->route('id'))->sortByDesc('finish_date') as $experience)
    <div class="formation flex py-4 border-b border-gray-400">
        <div class="self-center w-3/12 lg:w-1/12">
            <div class="text-center">
                <ion-icon class="text-4xl text-purple-500" name="briefcase-outline"></ion-icon>
            </div>
        </div>
        <div class="w-9/12 lg:w-11/12">
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">
                    {{ $experience->title }}
                </h1>
            </div>
            <div>
                <p class="text-xl text-gray-800">{{ $experience->enterprise }}</p>
                <p class="text-sm">{{ $experience->start_date }} - {{ $experience->finish_date }}</p>
            </div>
        </div>
    </div>
@empty
    <div class="px-3 pt-2 pb-1">
        <div class="alert alert-info">
            Vous n'avez encore ajouté aucune expériences
        </div>
    </div>
@endforelse
