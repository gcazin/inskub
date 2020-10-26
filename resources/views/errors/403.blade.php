@extends('layouts.base')

@section('content')
    <x-container>

        <x-section>
            <x-alert type="danger">Vous n'êtes pas autorisé à effectuer cette action.</x-alert>
        </x-section>

    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
