@extends('layouts.base')

@section('content')

    <x-container>
        <div class="row">
            <div class="col"><h1>Note "<span class="text-primary">{{ $note->title }}</span>"</h1></div>
            <div class="col text-right">
                <button data-toggle="modal" data-target="#edit-note" class="btn btn-outline-primary">Modifier</button>
            </div>

            <x-modal title="Editer la note" name="edit-note">
                <x-form :action="route('project.note.show', ['id' => $note->project_id, 'note_id' => $note->id])" method="PUT">
                    <x-input label="Titre" name="title" :value="$note->title"></x-input>
                    <x-textarea label="Description" name="description">{{ $note->description }}</x-textarea>
                    <x-submit>Valider</x-submit>
                </x-form>
            </x-modal>
        </div>

        <x-section>
            <p class="h5">{{ $note->description }}</p>
        </x-section>
    </x-container>

@endsection
