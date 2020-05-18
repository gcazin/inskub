@extends('layouts.base', ['full' => true])

@section('content')
    <div class="col-lg-6 offset-lg-1 mt-3">

        <div class="card w-100 border-0 shadow-sm px-3 pt-3 mb-3">
            <div class="row">
                <div class="col">
                    <h4 class="">Projet <span class="text-primary">{{ $project->title }}</span></h4>
                </div>
                <div class="col text-right">
                    A rendre {{ \Carbon\Carbon::parse($project->deadline)->diffForHumans() }}
                </div>
            </div>
            <p class="text-muted h5 pb-3">{{ $project->description }}</p>
        </div>

        @include('project.partials.post-list')
    </div>

    <x-right-sidebar>
        <div class="px-3">
            <div class="row no-gutters">
                <div class="col">
                    <h6 class="title__section text-uppercase text-secondary">Vos notes</h6>
                </div>
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target=".new-todo"><ion-icon class="h4" name="add-outline"></ion-icon></a>
                </div>

                <div class="modal fade new-todo" tabindex="-1" role="dialog" aria-labelledby="new-project" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Création d'une nouvelle note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <x-form :action="route('project.show', $project->id)">
                                    <div class="modal-body">
                                        <x-input label="Titre" name="title" placeholder="Mon super projet" required></x-input>
                                        <x-textarea label="Description" name="description" rows="3" required></x-textarea>

                                        <div class="modal-footer">
                                            <div class="container-fluid px-0">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-light btn-block" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-primary btn-block">Créer la note</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column overflow-hidden">
                @forelse(\App\Todo::where('project_id', $project->id) as $todo)
                    <div class="chat-person position-relative d-inline-flex align-items-center py-2 px-3">
                        <div style="width: 70%">
                            <span class="mr-auto font-weight-bold">{{ $todo->title }}</span>
                        </div>
                        <div class="text-center" style="width: 15%">
                            <span class="d-inline-block bg-success rounded-circle" style="height: 5px; width: 5px"></span>
                        </div>
                        <a class="position-absolute h-100 w-100" href="{{ route('chat.createConversation', $todo->id) }}"></a>
                    </div>
                @empty
                    <x-alert type="info">
                        Aucun élément à afficher ici
                    </x-alert>
                @endforelse
            </div>
        </div>
    </x-right-sidebar>
@endsection

@section('script')
    <script>
        let shareButton = document.querySelector('.share-button');

        shareButton.addEventListener('click', () => {
            if (navigator.share) {
                navigator.share({
                    title: 'WebShare API Demo',
                    url: 'https://codepen.io/ayoisaiah/pen/YbNazJ'
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
                    .catch(console.error);
            } else {
                console.log('Votre navigateur ne supporte pas ça')
                //shareDialog.classList.add('is-open');
            }
        });
    </script>
    <script>
        function displayPreview(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').removeClass('d-none')
                    $('#img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img-input").change(function(){
            displayPreview(this);
        });
    </script>
@endsection
