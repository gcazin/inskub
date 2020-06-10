@extends('layouts.base', ['header' => false])

@section('content')

    <!-- Formations -->
    <x-container>
        <h2>Offres d'emplois proposées</h2>
        @if(auth()->user()->role_id === 3)
            <div class="card__header--button">
                <a href="{{ route('job.create') }}">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </a>
            </div>
        @endif
        @include('partials.jobs-list')
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection
