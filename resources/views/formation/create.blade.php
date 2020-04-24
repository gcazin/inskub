@extends('layouts.base', ['full_width' => false, 'header' => false])

@section('content')
    <div class="lg:w-6/12 mx-auto">
        <h1 class="text-xl text-gray-700 mb-2">Publier une formation</h1>
        <div class="bg-white px-2 pt-1 pb-4 shadow rounded">
            <form action="{{ route('formation.create') }}" method="post">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="title">Titre de votre formation</label>
                    <input type="text" name="title" id="title" placeholder="Chef de projet..." value="{{ old('title') }}" required >
                </div>


                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="..." required maxlength="255">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="location">Localisation</label>
                    <input type="text" name="location" id="location" placeholder="Paris" value="{{ old('location') }}">
                </div>

                <div class="form-group">
                    <label for="salary">Prix d'entrée</label>
                    <input type="number" name="entry_price" id="entry_price" placeholder="1300" value="{{ old('entry_price') }}">
                </div>

                <button class="btn btn-blue btn-block" type="submit">Publier</button>
            </form>
        </div>
    </div>
@endsection
