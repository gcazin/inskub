@extends('layouts.base')

@section('content')
    <div class="container">
        <h1 class="text-xl mb-2 text-gray-800">Ajouter une formation</h1>
        <div class="card shadow bg-white shadow rounded">
            <div class="card__body px-3 py-2">
                <form action="{{ route('user.formation.create') }}" method="post">
                    <div class="form-group">
                        <label for="name">Nom de la formation</label>
                        <input type="text" name="" id="name" placeholder="Nom de la formation">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
