<div class="col-3 mb-3 text-center">
    <div class="bg-white shadow-sm rounded-lg p-4">

        <!-- Profile picture -->
        <div class="position-relative mb-4">
            <a href="{{ route('user.profile', $user->id) }}">
                <img style="height: 80px" class="rounded-lg border border-light" src="{{ $user->getAvatar($user->id) }}" alt="">
            </a>
            @if(request()->is('experts*') && $user->ratings()->count() >= 3)
                <div style="position: absolute;top: 58px;right: 32%; border: 1px solid transparent" class="icon-container-warning rounded-pill border-yellow-200">
                    <ion-icon name="star" class="text-yellow align-text-top animate__animated animate__jello"></ion-icon>
                    <span class="text-black-50">{!! $user->ratings()->avg('rating') !!}</span>
                </div>
            @endif
        </div>

        <div class="mb-4">
            <a href="{{ route('user.profile', $user->id) }}" class="h5 text-primary">
                {{ $user->first_name }} {{ $user->last_name }}
            </a>
        </div>

        <div class="mb-4">
            <div class="row">
                <div class="col">
                    <p class="text-black-50">Publications</p>
                    <p class="text-primary h4">{{ $user->posts->count() }}</p>
                </div>
                <div class="col">
                    <p class="text-black-50">Abonnés</p>
                    <p class="text-primary h4">{{ $user->followers->count() }}</p>
                </div>
                <div class="col">
                    <p class="text-black-50">Abonnements</p>
                    <p class="text-primary h4">{{ $user->followings->count() }}</p>
                </div>
            </div>
        </div>

        @if(request()->is('experts*'))
            <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target=".new-expertise-{{ $user->id }}">
                Demander une expertise
            </button>

            <div class="text-left">
                <x-element.modal title="Demande d'expertise" name="new-expertise-{{ $user->id }}">
                    <x-form.item :action="route('expert.request', $user->id)">

                        <!-- Brève description du sinistre -->
                        <x-form.textarea label="Description" name="short_description" rows="3" placeholder="Veuillez inclure ici une brève description de votre demande."></x-form.textarea>

                        <!--Information client -->
                        <x-form.textarea label="Vos informations" name="detailed_description" rows="3" placeholder="Renseigné à l'expert des informations complémentaires tel que votre ville ou tout autre information qui pourrait vous semblait utile pour traiter au mieux votre demande."></x-form.textarea>

                        <div class="form-group">

                        </div>

                        <hr>
                        <x-form.submit>Envoyer la demande</x-form.submit>
                    </x-form.item>
                </x-element.modal>
            </div>
        @else
            <x-element.link-button :url="route('user.profile', $user->id)" type="outline-primary">Voir le profil</x-element.link-button>
        @endif
    </div>
</div>
