@forelse(\App\UserFormation::all()->where('user_id', request()->route('id'))->sortByDesc('finish_date') as $formation)
    <div class="formation flex py-4 border-b border-gray-400">
        <div class="self-center w-3/12 lg:w-1/12">
            <div class="text-center">
                <ion-icon class="text-4xl text-blue-500" name="school-outline"></ion-icon>
            </div>
        </div>
        <div class="w-9/12 lg:w-11/12">
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">
                    {{ $formation->school }}
                </h1>
            </div>
            <div>
                <p class="text-xl text-gray-800">{{ $formation->degree }}</p>
                <p class="text-sm">{{ $formation->start_date }} - {{ $formation->finish_date }}</p>
            </div>
        </div>
    </div>
@empty
    <div class="px-3 pt-2 pb-1">
        <div class="alert alert-info">
            Vous n'avez encore ajouté aucune formations
        </div>
    </div>
@endforelse
