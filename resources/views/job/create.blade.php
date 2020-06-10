@extends('layouts.base')

@section('content')
    <x-container>
        <h1 class="text-xl text-gray-700 mb-2">Publier une offre d'emploi</h1>
        <x-section>
            <x-form :action="route('job.create')">
                <x-input label="Titre de votre annonce" name="title" placeholder="Chef de projet..." required></x-input>
                <x-textarea label="Description" name="description" placeholder="..." required maxlength="255"></x-textarea>
                <x-input type="number" label="Heures" name="hours" placeholder="35h" required></x-input>
                <x-input label="Salaire" name="salary" placeholder="1300" required></x-input>
                <div class="form-group">
                    <label for="type_id">Type d'emploi</label>
                    <select name="type_id" id="type_id" required>
                        @foreach(\App\Job_type::all() as $job_type)
                            <option data-description="{{ $job_type->description }}" value="{{ $job_type->id }}">{{ $job_type->title }}</option>
                        @endforeach
                    </select>
                </div>
                <x-submit>Publier</x-submit>
            </x-form>
        </x-section>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
