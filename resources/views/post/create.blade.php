@extends('layouts.base', ['full_width' => false])

@section('content')
    <h1 class="text-xl text-gray-700 mb-2">Publier un contenu</h1>
    <div class="bg-white px-2 pt-1 pb-4 shadow rounded">
        <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
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
                <label for="content">Contenu</label>
                <textarea name="content" id="content" placeholder="Votre message" required maxlength="255">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <select id="visibility" name="visibility_id" id="visibility_id" required>
                    @foreach(\App\VisibilityPost::all() as $visibilityPost)
                        <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="media">Media</label>
                <input type="file" name="media" id="media">
            </div>

            <div class="form-group">
                <span id="description" class="text-sm text-gray-600"></span>
            </div>
            <button class="btn btn-blue btn-block" type="submit">Publier</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('#visibility').change(function(){
            let $selected = $(this).find(':selected');

            $('#description').html($selected.data('description'));
        }).trigger('change');
    </script>
@endsection
