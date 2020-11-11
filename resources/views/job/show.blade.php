@extends('layouts.base')

@section('content')

    <x-container>

        <x-header title="Détails" description="Informations détaillés à propos de cet emploi"></x-header>

        <x-section>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <p class="text-muted">Intitulé du poste</p>
                    <span>{{ $job->title }}</span>
                </li>
                <li class="list-group-item">
                    <p class="text-muted">Entreprise</p>
                    <span>{{ ucfirst(\App\User::find($job->user_id)->last_name) }}</span>
                </li>
                <li class="list-group-item">
                    <p class="text-muted">Salaire</p>
                    <span>{{ $job->salary ?? 'Salaire non spécifié' }}€</span>
                </li>
                <li class="list-group-item">
                    <p class="text-muted">Description</p>
                    <span>{{ $job->description }}</span>
                </li>
                <li class="list-group-item">
                    <p class="text-muted">Contact</p>
                    <ul>
                        <li>Prendre contact sur le site
                            <br><a href="{{ route('chat.createConversation', $job->user_id) }}" class="btn btn-primary btn-sm my-2">
                                Envoyer un message privé
                            </a>
                        </li>

                        <li>Prendre contact par mail
                            <br><a target="_blank" href="mailto:{{ \App\User::find($job->user_id)->email }}" class="btn btn-outline-primary btn-sm my-2">
                                Envoyer un mail
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>

        </x-section>

    </x-container>
@endsection
