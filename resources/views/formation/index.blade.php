@extends('layouts.base')

@section('content')
    <x-container>
        <h2 class="text-muted mb-4">Formations proposées</h2>
        @include('partials.formations-list')
    </x-container>
@endsection
