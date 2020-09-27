@extends('layouts.base', ['full_width' => false])

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('title')
    Rechercher parmis les experts
@endsection

@section('content')
    <x-container>
        <h2 class="text-black-50 mb-4">Rechercher parmis les experts</h2>

        <x-section>
            <x-form :action="route('expert.search')">
                <div class="form-group">
                    <label>Domaine de compétence</label>
                    <select class="skills form-control" id="skills" name="skills[]" multiple>
                        @foreach(\App\UserSkill::all() as $skill)
                            <option value="{{ $skill->id }}">{{ ucfirst($skill->title) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="departments">Localisation</label>
                    <select class="departments form-control" id="departments" name="departments[]" multiple>
                        @foreach(\App\Department::all()->sortBy('code') as $department)
                            <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="company" id="switch1">
                        <label class="custom-control-label" for="switch1">Compagnie agrée</label>
                    </div>
                </div>
                <x-submit>Rechercher</x-submit>
            </x-form>
        </x-section>
    </x-container>
    <x-right-sidebar-message></x-right-sidebar-message>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.skills').select2();
            $('.departments').select2();
        });
    </script>
@endsection
