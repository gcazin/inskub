@extends('layouts.base')

@section('title')
    Modifier les options du compte
@endsection

@section('content')
    <x-account-content title="Changer vos préférences générales">

        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="visibility">
                <label class="custom-control-label" for="visibility">Apparaitre dans les moteurs de recherche</label>
            </div>
        </div>

    </x-account-content>
@endsection
