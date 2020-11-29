<x-page title="Profil de {{ $user->first_name . ' ' . $user->last_name }}">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-header>
        <x-slot name="title">
            <img alt="avatar" src="{{ $user::getAvatar($user->id) }}" height="100" class="rounded-circle shadow-sm mr-3">
            Profil de {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}
        </x-slot>
        <x-slot name="content">
                    <div class="row">
                        <div class="col">
                            <p class="h4">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</p>
                        </div>

                        <div class="col text-right">
                            @if(auth()->id() === (int) $user->id)
                                <a class="h4" href="{{ route('user.edit') }}">
                                    <ion-icon class="icon-container-primary align-bottom" name="settings-outline"></ion-icon>
                                </a>
                            @else
                                <livewire:follow-user :member="$user->id">
                                    <a class="ml-1" href="{{ route('chat.createConversation', $user->id) }}">
                                        <ion-icon class="icon-container align-text-bottom h5 mb-0" name="chatbubble-outline"></ion-icon>
                                    </a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('user.follower', $user->id) }}">
                            {{ auth()->user()->followers->count() }} abonnés
                        </a> -
                        <a href="{{ route('user.following', $user->id) }}">
                            {{ auth()->user()->followings->count() }} abonnements
                        </a>
                    </div>

        </x-slot>
    </x-header>

    <x-container>

        <x-user.about
            title="A propos"
            target="userAbout">
            @isset($user->about)
                {{ $user->about }}
            @else
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune description renseignée
                    </x-slot>
                </x-element.alert>
            @endisset
        </x-user.about>

        <x-user.about
            title="Dernières publications">

            @forelse(\App\Models\Post::where('user_id', $user->id)->take(5)->get() as $post)
                <div class="job-post border rounded p-3 mb-3">
                    <div class="row">
                        <div class="col">
                            <p class="font-bold">
                                {{ $post->content }}
                            </p>
                        </div>
                        <div class="col h5 text-right">
                <span class="badge badge-primary">
                    {{ $post->created_at->diffForHumans() }}
                </span>
                        </div>
                    </div>
                </div>
                @if($loop->last)
                    <div class="text-center">
                        <a href="{{ $post }}" class="btn btn-primary mx-auto">Voir toutes les publications</a>
                    </div>
                @endif
            @empty
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune publication à afficher
                    </x-slot>
                </x-element.alert>
            @endforelse

        </x-user.about>

        @if((int) auth()->id() === (int) request()->id)
            <x-element.modal title="Ajouter une expérience" name="userAbout">
                <x-form.item :action="route('user.profile', auth()->id())">
                    <x-form.textarea label="Description" name="about"></x-form.textarea>

                    <x-form.submit>Valider</x-form.submit>
                </x-form.item>
            </x-element.modal>
    @endif

    <!-- Etudiants et salariés -->
    @if($user->role_id === 2 || $user->role_id === 5)
        <!-- Expériences -->
            <x-user.about
                title="Expériences"
                target="create-experience">
                @include('user.partials.experiences-list')
            </x-user.about>

            <x-element.modal title="Ajouter une expérience" name="create-experience">
                <x-form.item :action="route('user.experience.create')" method="post">

                    <x-form.input label="Titre" name="title" placeholder="Intitulé du poste"></x-form.input>
                    <x-form.input label="Entreprise" name="enterprise" placeholder="Entreprise concernée..."></x-form.input>
                    <x-form.input label="Localisation" name="location" placeholder="Paris..."></x-form.input>
                    <x-form.input label="Secteur" name="sector" placeholder="Assurance..."></x-form.input>

                    <div class="row">
                        <div class="col">
                            <x-form.input label="Date de début" name="start_date" :placeholder="now()->year-1"></x-form.input>
                        </div>

                        <div class="col">
                            <x-form.input label="Date de fin" name="finish_date" :placeholder="now()->year"></x-form.input>
                        </div>
                    </div>

                    <x-form.input label="Description" name="description" placeholder="Informations en plus..."></x-form.input>

                    <x-form.submit>Valider</x-form.submit>
                </x-form.item>
            </x-element.modal>

            <!-- Formations -->
            <x-user.about
                title="Formations"
                target="create-formation">
                @include('user.partials.formations-list')
            </x-user.about>

            <x-element.modal title="Ajouter une formation" name="create-formation">
                <x-form.item :action="route('user.formation.create')" method="post">

                    <x-form.input label="Ecole" name="school" placeholder="Université de..." required></x-form.input>
                    <x-form.input label="Diplôme" name="degree" placeholder="Licence..."></x-form.input>
                    <x-form.input label="Domaine d'étude" name="study_area" placeholder="Assurance en..."></x-form.input>
                    <div class="row">
                        <div class="col">
                            <x-form.input label="Date de début" name="start_date" :placeholder="now()->year-1"></x-form.input>
                        </div>

                        <div class="col">
                            <x-form.input label="Date de fin" name="finish_date" :placeholder="now()->year"></x-form.input>
                        </div>
                    </div>
                    <x-form.textarea label="Description" name="description" placeholder="..."></x-form.textarea>
                    <x-form.submit>Valider</x-form.submit>
                </x-form.item>
            </x-element.modal>
    @endif

    <!-- Entreprise -->
        @role('company')
        <!-- Emplois -->
        <x-user.about
            title="Emplois proposés"
            target="create-job">
            @include('user.partials.jobs-list')
        </x-user.about>

        <x-element.modal title="Publier une offre d'emploi" name="create-job">
            <!-- Form -->
            <x-form.item :action="route('user.experience.create')" method="post">

                <x-form.input label="Titre" name="title" placeholder="Intitulé du poste"></x-form.input>
                <x-form.input label="Entreprise" name="enterprise" placeholder="Entreprise concernée..."></x-form.input>
                <x-form.input label="Localisation" name="location" placeholder="Paris..."></x-form.input>
                <x-form.input label="Secteur" name="sector" placeholder="Assurance..."></x-form.input>
                <x-form.input label="Secteur" name="sector" placeholder="Assurance..."></x-form.input>

                <div class="row">
                    <div class="col">
                        <x-form.input label="Date de début" name="start_date" :placeholder="now()->year-1"></x-form.input>
                    </div>

                    <div class="col">
                        <x-form.input label="Date de fin" name="finish_date" :placeholder="now()->year"></x-form.input>
                    </div>
                </div>

                <x-form.input label="Description" name="description" placeholder="Informations en plus..."></x-form.input>

                <x-form.submit>Valider</x-form.submit>
            </x-form.item>
        </x-element.modal>
        @endrole

        <!-- Ecole -->
        @role('school')
        <!-- Formations -->
        <x-user.about
            title="Formations proposées"
            target="create-formation">
            @include('user.partials.formations-list')
        </x-user.about>

        <x-element.modal title="Ajouter une formation" name="create-formation">
            <x-form.item :action="route('user.formation.create')">
                <x-form.input label="Ecole" name="school" placeholder="Université de ..."></x-form.input>
                <x-form.input label="Diplôme" name="degree" placeholder="Licence ..."></x-form.input>
                <x-form.input label="Domaine d'étude" name="study_area" placeholder="Assurance en ..."></x-form.input>
                <div class="row">
                    <div class="col">
                        <x-form.input name="finish_date" type="number" label="Date de début"></x-form.input>
                    </div>
                    <div class="col">
                        <x-form.input type="number" label="Date de fin" name="finish_date" :placeholder="now()->year"></x-form.input>
                    </div>
                </div>
                <x-form.textarea label="Description" name="description" placeholder="Informations en plus..."></x-form.textarea>

                <x-form.submit>Valider</x-form.submit>
            </x-form.item>
        </x-element.modal>
        @endrole

        <x-user.about
            title="Compétences"
            target="create-skill">
            @include('user.partials.skills-list')
        </x-user.about>

        <x-element.modal title="Ajouter une compétence" name="create-skill">
            <x-form.item :action="route('user.skill.create')" method="post">
                <div class="form-group">
                    <label>Domaine de compétence</label>
                    <select class="skills form-control" id="skills" name="skills[]" multiple style="width: 100%">
                        @foreach(\App\Models\Skill::all() as $skill)
                            <option value="{{ $skill->id }}">{{ ucfirst($skill->title) }}</option>
                        @endforeach
                    </select>
                </div>
                <x-form.submit>Valider</x-form.submit>
            </x-form.item>
        </x-element.modal>
    </x-container>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.skills').select2();
            });
        </script>
    </x-slot>
</x-page>
