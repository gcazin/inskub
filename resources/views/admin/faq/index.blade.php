@extends('admin.layouts.admin')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h2>Gestion de la FAQ</h2>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-faq">
                <ion-icon class="align-text-top mb-0 h5" name="add-outline"></ion-icon> Créer une question-réponse
            </button>
        </div>

        <x-modal title="Création d'une nouvelle question-réponse" name="new-faq" size="">
            <x-form :action="route('admin.faq.store')">
                <x-input label="Titre" name="title"></x-input>
                <x-input label="Description" name="description"></x-input>
                <x-submit>Créer la question</x-submit>
            </x-form>
        </x-modal>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->title }}</td>
                <td>{{ $faq->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $faqs->links() }}
@endsection
