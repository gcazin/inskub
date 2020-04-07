@extends('layouts.base', ['full_width' => false])

@section('content')
    <form action="{{ route('post.create') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="border-0 p-3 w-full" name="content" id="content" placeholder="Votre message"></textarea>
        </div>
        <div class="form-group">
            <select id="visibility" name="visibility_id" id="visibility_id">
                @foreach(\App\VisibilityPost::all() as $visibilityPost)
                    <option data-description="{{ $visibilityPost->description }}" value="{{ $visibilityPost->id }}">{{ $visibilityPost->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <span id="description" class="text-sm text-gray-600"></span>
        </div>
        <button class="btn btn-blue btn-block" type="submit">Publier</button>
    </form>
@endsection

@section('script')
    <script>
        $('#visibility').change(function(){
            let $selected = $(this).find(':selected');

            $('#description').html($selected.data('description'));
        }).trigger('change');
    </script>
@endsection
