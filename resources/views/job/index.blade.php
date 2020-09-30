@extends('layouts.base', ['header' => false])

@section('content')

    <!-- Formations -->
    <x-container>
        <x-header title="Offres d'emplois proposés"></x-header>

        <x-section>
            @if(auth()->user()->role_id === 3)
                <div class="card__header--button">
                    <a href="{{ route('job.create') }}">
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </a>
                </div>
            @endif
            @include('partials.jobs-list')
        </x-section>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>

@endsection
