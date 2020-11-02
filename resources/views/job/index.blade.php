<x-page>
    <x-header>
        <x-slot name="title">
            Offres d'emplois proposés
        </x-slot>
        <x-slot name="content">
            <div class="row">
                <div class="col">
                    <input type="search" disabled class="form-control" placeholder="Désactiver pour le moment, veuillez réessayer ultérieurement.">
                </div>
                @role('school')
                <div class="col-2">
                    <a class="btn btn-outline-primary btn-block" href="{{ route('job.create') }}">
                        Proposer une offre
                    </a>
                </div>
                @endrole
            </div>
        </x-slot>
    </x-header>

    <x-container>
        @forelse($jobs as $job)
            <x-section>
                <a href="{{ route('job.show', $job->id) }}" class="text-decoration-none">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-primary">{{ $job->title }}</h4>
                        </div>
                        <div class="col text-right">
                            <small>{{ \Carbon\Carbon::make($job->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                    <p>{{ $job->description }}</p>
                    <small>
                        Publiée par
                        <img class="rounded-circle" style="height: 30px" src="{{ \App\Models\User::getAvatar($job->user_id) }}" alt=""> {{ \App\Models\User::find($job->user_id)->last_name }}
                    </small>
                </a>
            </x-section>
        @empty
            <div class="px-3 pt-2 pb-1">
                <div class="alert alert-info">
                    Vous n'avez encore ajouté aucune formations
                </div>
            </div>
        @endforelse

        <div class="mt-3">
            {{ $jobs->links() }}
        </div>
    </x-container>
</x-page>
