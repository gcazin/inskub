@extends('layouts.base')

@section('content')

    <!-- Formations -->
    <div class="w-11/12 lg:w-7/12 mx-auto mb-3">
        <div class="card">
            <div class="card__header">
                <div class="card__header--title">
                    <h2>Formations</h2>
                </div>
                <div class="card__header--button">
                    <a href="{{ route('job.create') }}">
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="card__body">
                @include('partials.jobs-list')
            </div>
        </div>
    </div>

@endsection
