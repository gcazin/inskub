<div class="px-3 py-4 shadow-sm rounded-lg position-relative bg-white">
    <div class="row align-items-center">
        <div class="col col-lg-1 text-center">
            @if($project->type === $project::EXPERTISE)
                <ion-icon class="h2 mb-0 text-info icon-container-info" name="briefcase-outline"></ion-icon>
            @else
                <ion-icon class="h2 mb-0 text-primary icon-container-primary" name="folder-open-outline"></ion-icon>
            @endif
        </div>
        <div class="col col-lg-5 h5 text-secondary">
            {{ $project->title }}
        </div>
        <div class="col col-lg-2">
            @forelse($project->find($project->id)->participants()->take(3)->get() as $participant)
                <img class="rounded-circle" style="height: 30px" src="{{ $participant::getAvatar($participant->id) }}" alt="">
            @empty
            @endforelse
        </div>
        <div class="col col-lg-2 h5">
            @if($project->finish !== 0)
                <span class="badge badge-pill badge-success">Terminé</span>
            @else
                <span
                    class="badge badge-pill badge-{{ $project::daysLeft($project, true) }}">
                                    {{ \App\Helpers\carbon()::parse($project->deadline)->formatLocalized('%d %b %Y') }}
                                </span>
            @endif
        </div>
        <div class="col col-lg-1 d-none d-lg-block">
                           <span class="text-muted">
                                {{ $project::daysLeft($project) }}
                           </span>
        </div>
        <div class="col col-lg-1" style="z-index: 99999">
            <div class="dropdown dropdown-none">
                <button class="btn rounded-circle dropdown-toggle"
                        type="button" id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </button>
                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('project.edit', $project->id) }}">Modifier</a>
                    <x-form.item :action="route('project.destroy', $project->id)" method="delete">
                        <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                    </x-form.item>
                </div>
            </div>
        </div>
        <a href="{{ route('project.show', $project->id) }}" class="position-absolute h-100 w-100" style="top: 0; bottom: 0; left: 0; right: 0"></a>
    </div>
</div>
