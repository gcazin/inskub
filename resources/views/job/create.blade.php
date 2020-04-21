@extends('layouts.base', ['full_width' => false])

@section('content')
    <div class="lg:w-6/12 mx-auto">
        <h1 class="text-xl text-gray-700 mb-2">Publier une offre d'emploi</h1>
        <div class="bg-white px-2 pt-1 pb-4 shadow rounded">
            <form action="{{ route('job.create') }}" method="post">
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
                    <label for="title">Titre de votre annonce</label>
                    <input type="text" name="title" id="title" placeholder="Chef de projet..." value="{{ old('title') }}" required >
                </div>


                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="..." required maxlength="255">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="hours">Heures</label>
                    <input type="number" name="hours" id="hours" placeholder="35h" value="{{ old('hours') }}">
                </div>

                <div class="form-group">
                    <label for="salary">Salaire</label>
                    <input type="number" name="salary" id="salary" placeholder="1300" value="{{ old('salary') }}">
                </div>

                <div class="form-group">
                    <label for="type_id">Type d'emploi</label>
                    <select name="type_id" id="type_id" required>
                        @foreach(\App\Job_type::all() as $job_type)
                            <option data-description="{{ $job_type->description }}" value="{{ $job_type->id }}">{{ $job_type->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-blue btn-block" type="submit">Publier</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
