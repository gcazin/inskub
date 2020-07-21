@extends('layouts.base', ['header' => false])

@section('content')
    <x-container>
        <x-section>
            <x-form :action="route('project.update', $project->id)" method="put">
                <x-input label="Titre" name="title" :value="$project->title"></x-input>
                <x-textarea label="Description" name="description" :value="$project->description"></x-textarea>

                <x-submit>
                    Modifier le projet
                </x-submit>
            </x-form>
        </x-section>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection
